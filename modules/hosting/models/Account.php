<?php

namespace app\modules\hosting\models;

use app\modules\documentation\components\MenuArrayBehavior;
use panix\engine\behaviors\nestedsets\NestedSetsBehavior;
use panix\engine\behaviors\TranslateBehavior;
use panix\engine\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use Yii;
class Account extends ActiveRecord
{


    const MODULE_ID = 'documentation';
    const route = '/admin/documentation/default';

    // public $aliasPathImage = 'uploads.shop.categories';

    public $tags;
    public static function find() {
        return new AccountQuery(get_called_class());
    }



    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%hosting_account}}';
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            'translate' => [
                'class' => TranslateBehavior::className(),
                'translationAttributes' => ['name', 'description']
            ],
            'MenuArrayBehavior' => array(
                'class' => MenuArrayBehavior::className(),
                'labelAttr' => 'name',
                // 'countProduct'=>false,
                'urlExpression' => '["/documentation/default/view", "seo_alias"=>$model->full_path]',
            ),
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                // 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                //'levelAttribute' => 'level',
            ],
        ], parent::behaviors());
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules2()
    {
        return array(
            array('name', 'required'),
            array('name', 'StripTagsValidator'),
            array('seo_alias', 'TranslitValidator', 'translitAttribute' => 'name'),
            array('name, seo_alias, image', 'length', 'max' => 255),
            array('description, tags', 'type', 'type' => 'string'),
            // Search
            array('id, name, seo_alias', 'safe', 'on' => 'search'),
        );
    }

    public function behaviors2()
    {
        return array(
            'tags' => array(
                'class' => 'app.behaviors.TagsBehavior',
                'router' => '/documentation/default/index'
            ),
            'seo' => array(
                'class' => 'mod.seo.components.SeoBehavior',
                'url' => $this->getUrl()
            ),
            'NestedSetBehavior' => array(
                'class' => 'app.behaviors.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
            ),
            'MenuArrayBehavior' => array(
                'class' => 'mod.documentation.components.MenuArrayBehavior',
                'labelAttr' => 'name',
                // 'countProduct'=>false,
                'urlExpression' => 'array("/documentation/default/view", "seo_alias"=>$model->full_path)',
            ),
            'TranslateBehavior' => array(
                'class' => 'app.behaviors.TranslateBehavior',
                'relationName' => 'cat_translate',
                'translateAttributes' => array(
                    'name',
                    'description',
                ),
            ),
        );
    }

    /**
     * Find category by url.
     * Scope.
     *
     * @param string $url
     * @param string $alias
     * @return documentation
     */
    public function withUrl($url, $alias = 't')
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => $alias . '.seo_alias=:url',
            'params' => array(':url' => $url)
        ));
        return $this;
    }

    /**
     * Find category by url.
     * Scope.
     *
     * @param string $url
     * @param string $alias
     * @return ShopProduct
     */
    public function withFullPath($url, $alias = 't')
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => $alias . '.full_path=:url',
            'params' => array(':url' => $url)
        ));
        return $this;
    }

    /**
     * @param $alias
     * @return documentation
     */
    public function excludeRoot($alias = 't')
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => $alias . '.id != 1',
        ));
        return $this;
    }

    /**
     * @return array relational rules.
     */
    public function relations2()
    {
        return array(
            //  'countProducts' => array(self::STAT, 'ShopProductCategoryRef', 'category', 'condition' => '`t`.`switch`=1'),
            //  'manufacturer' => array(self::HAS_MANY, 'ShopManufacturer', 'cat_id'),
            'pages' => array(self::MANY_MANY, 'Documentation', array('category_id' => 'id')),
            'pages2' => array(self::BELONGS_TO, 'Documentation', 'id'),
            'cat_translate' => array(self::HAS_ONE, $this->translateModelName, 'object_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels2()
    {
        $this->_attrLabels = array(
            'name' => Yii::t('app', 'Название'),
            'full_path' => Yii::t('app', 'Полный путь'),
            'description' => Yii::t('app', 'Описание'),
        );
        return CMap::mergeArray($this->_attrLabels, parent::attributeLabels());
    }

    public function beforeSave2()
    {
        if (empty($this->seo_alias)) {
            // Create slug
            // Yii::import('ext.SlugHelper.SlugHelper');
            // $this->seo_alias = SlugHelper::run($this->name);
        }

        // Check if url available
        if ($this->isNewRecord) {
            $test = Documentation::model()
                ->withUrl($this->seo_alias)
                ->count();
        } else {
            $test = Documentation::model()
                ->withUrl($this->seo_alias)
                ->count('id!=:id', array(':id' => $this->id));
        }

        // Create unique url
        if ($test > 0)
            $this->seo_alias .= '-' . date('YmdHis');

        $this->rebuildFullPath();

        return parent::beforeSave();
    }

    public function afterDelete2()
    {

        $this->clearRouteCache();

        return parent::afterDelete();
    }

    public function afterSave2()
    {
        $this->clearRouteCache();

        return parent::afterSave();
    }

    /**
     * Rebuild category full_path
     */
    public function rebuildFullPath()
    {
        // Create category full path.
        $ancestors = $this->ancestors()->language(Yii::app()->languageManager->active->code)->findAll();
        if (sizeof($ancestors)) {
            // Remove root category from path
            unset($ancestors[0]);

            $parts = array();
            foreach ($ancestors as $ancestor)
                $parts[] = $ancestor->seo_alias;

            $parts[] = $this->seo_alias;
            $this->full_path = implode('/', array_filter($parts));
        }

        return $this;
    }

    /**
     * @return array
     */
    public static function flatTree()
    {
        $result = array();
        $categories = Documentation::model()
            ->published()
            ->language(Yii::app()->languageManager->active->code)
            ->findAll(array('order' => 'lft'));
        array_shift($categories);

        foreach ($categories as $c) {

            if ($c->level > 2) {
                $result[$c->id] = str_repeat('--', $c->level - 1) . ' ' . $c->name;
            } else {
                $result[$c->id] = ' ' . $c->name;
            }
        }

        return $result;
    }



    /**
     * @return string
     */
    public function getUrl()
    {
        $url = ['/documentation/default/view', 'seo_alias' => $this->full_path];
        return $url;
    }

    public function clearRouteCache()
    {
        Yii::app()->cache->delete('DocumentationUrlRule');
    }

}
