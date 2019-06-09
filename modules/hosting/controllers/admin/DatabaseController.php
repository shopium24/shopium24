<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use panix\engine\Html;
use app\modules\hosting\components\Api;
use app\modules\hosting\forms\hosting_database\DatabaseCreateForm;
use app\modules\hosting\forms\hosting_database\UserPasswordForm;
use app\modules\hosting\forms\hosting_database\UserPrivilegesForm;

class DatabaseController extends CommonController
{
    /**
     * Возвращает информацию о базах данных аккаунта.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->buttons[] = [
            'label' => Yii::t('hosting/default', 'BTN_DATABASE_CREATE'),
            'url' => ['database-create'],
            'options' => ['class' => 'btn btn-success']
        ];

        $api = new Api('hosting_database', 'info');
        if ($api->response['status'] == 'success') {
            return $this->render('index', ['response' => $api->response['data']]);
        } else {
            Yii::$app->session->setFlash('danger', $api->response['message']);

        }
    }


    /**
     * Создание базы данных.
     *
     * @return string
     */
    public function actionDatabaseCreate()
    {
        $params = [];
        if (Yii::$app->request->get('db')) {
            $params['database'] = Yii::$app->request->get('db');
        } else {

        }
        $model = new DatabaseCreateForm();

        // $api = new Api('hosting_database', 'info',$params);

        //print_r($api->response['data']);die;
        $response = false;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $api = new Api('hosting_database', 'database_create', [
                'name' => $model->name,
                'collation' => $model->collation,
                'user_create' => $model->user_create
            ]);
            if ($api->response['status'] == 'success') {
                $response = $api->response['data'];
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_DATABASE_CREATE', ['db' => $model->name]));
            } else {
                Yii::$app->session->setFlash('danger', $api->response['message']);

                $model->addError('name', $api->response['message']);
            }
        }
        return $this->render('database_create', [
            'model' => $model,
            'response' => $response
        ]);
    }

    /**
     * Смена пароля пользователя базы данных.
     *
     * @return string
     */
    public function actionUserPassword()
    {
        $this->pageName = Yii::t('hosting/default', 'HOSTING_DATABASE_USER_PASSWORD2', [
            'user' => Yii::$app->request->get('user')
        ]);

        $model = new UserPasswordForm();
        $model->user = Yii::$app->request->get('user');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_DATABASE_USERPASSWORD_UPDATE'));
            }

        }
        return $this->render('user_password', [
            'model' => $model,
            'response' => $model->api
        ]);
    }

    /**
     * Изменение привилегий доступа пользователя базы данных к соответствующей базе данных.
     *
     * @param int $user_id Пользователь базы данных
     * @param string $user Пользователь базы данных
     * @param string $database База данных
     * @return string
     */
    public function actionUserPrivileges($user_id,$user,$database)
    {
        $model = new UserPrivilegesForm();
        $model->user = $user;
        $model->database = $database;



        $api = new Api('hosting_database', 'info', [
            'user' => $model->user,
            'database' => $model->database,
        ]);


        $model->privileges = $api->response['data']['users'][$user_id]['privileges'];
        $response = false;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $api = new Api('hosting_database', 'user_privileges', [
                'user' => $model->user,
                'database' => $model->database,
                'privileges' => $model->privileges,
            ]);
            if ($api->response['status'] == 'success') {
                $response = $api->response['data'];
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_DATABASE_USERPRIVILEGES_UPDATE', ['user' => $model->user]));
            } else {
                Yii::$app->session->setFlash('danger', $api->response['message']);
                $model->addError('user', ($api->response['message']));
            }
        }
        return $this->render('user_privileges', ['model' => $model, 'response' => $response]);
    }

    /**
     * Удаление базы данных.
     *
     * @param string $database База данных
     * @return string
     */
    public function actionDatabaseDelete($database)
    {
        if (Yii::$app->request->get('database')) {
            $api = new Api('hosting_database', 'database_delete', [
                'database' => $database,
            ]);
            if ($api->response['status'] == 'success') {
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_DATABASE_DELETE', ['db' => $api->response['data'][0]]));
            } else {
                Yii::$app->session->setFlash('danger', 'error databse_create');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Удаление пользователя базы данных и всех его привилегий.
     *
     * @param string $user Пользователь базы данных
     * @return string
     */
    public function actionUserDelete($user)
    {
        if ($user) {
            $api = new Api('hosting_database', 'user_delete', [
                'user' => $user,
            ]);
            if ($api->response['status'] == 'success') {
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_DATABASE_USER_DELETE', ['user' => $user]));
            } else {
                Yii::$app->session->setFlash('danger', $api->response['message']);
            }
        }
        return $this->redirect(['index']);
    }

    public function getAddonsMenu2()
    {
        return [
            [
                'label' => Yii::t('app', 'user-privileges'),
                'url' => ['user-privileges'],
                'icon' => Html::icon('user'),
            ],
        ];
    }
}
