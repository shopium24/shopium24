<?php

namespace app\frontend\web\themes\shopium24\assets;

use panix\engine\web\AssetBundle;

class ThemeAsset extends AssetBundle {

    private $_theme;

    public function init() {
        $this->_theme = \Yii::$app->settings->get('app', 'theme');
        $this->sourcePath = "@frontend/themes/{$this->_theme}/assets";
        parent::init();
    }


    public $css = [
        'css/plan.css',
        'css/theme.css',
    ];

    public $depends = [
        'panix\engine\assets\JqueryCookieAsset',
        'panix\engine\assets\CommonAsset',
        'panix\mod\comments\assets\WebAsset',
    ];

}
