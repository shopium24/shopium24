<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use panix\engine\controllers\AdminController;
use app\modules\hosting\forms\SettingsForm;

class SettingsController extends AdminController {



    public function actionIndex(){
        $this->pageName = Yii::t('app', 'SETTINGS');
        $this->breadcrumbs = [
            [
                'label' => $this->module->info['label'],
                'url' => $this->module->info['url'],
            ],
            $this->pageName
        ];
        
        $model = new SettingsForm();
        //Yii::$app->request->post()
        if ($model->load(Yii::$app->request->post())) {
            $model->save();

        }
        return $this->render('index', [
            'model'=>$model
        ]);
    }

}
