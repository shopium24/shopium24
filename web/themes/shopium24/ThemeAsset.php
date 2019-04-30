<?php

namespace app\web\themes\shopium24;

use Yii;
use panix\engine\web\AssetBundle;

/**
 * Class ThemeAsset
 * @package app\web\themes\shopium24
 */
class ThemeAsset extends AssetBundle
{

    public $sourcePath = __DIR__ . "/assets";

    public $css = [
        'css/plan.css',
        'css/theme.css',
    ];

    public function init()
    {
        $this->depends[] = 'panix\engine\assets\JqueryCookieAsset';
        $this->depends[] = 'panix\engine\assets\CommonAsset';

        if (Yii::$app->hasModule('comments')) {
            $this->depends[] = 'panix\mod\comments\WebAsset';
        }
        parent::init();
    }


}
