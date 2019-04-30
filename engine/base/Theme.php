<?php

namespace app\engine\base;

use Yii;

class Theme extends \panix\engine\base\Theme
{

    public function init()
    {
        if ($this->name == null) {
            $this->name = Yii::$app->settings->get('app', 'theme');
        }

        parent::init();
    }

}
