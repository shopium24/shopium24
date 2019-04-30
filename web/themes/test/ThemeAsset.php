<?php

namespace app\web\themes\shopium24;

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

    public $depends = [
        'panix\engine\assets\JqueryCookieAsset',
        'panix\engine\assets\CommonAsset',
        'panix\mod\comments\assets\WebAsset',
    ];

}
