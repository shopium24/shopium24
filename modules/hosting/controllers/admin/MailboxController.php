<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use app\modules\hosting\components\Api;
use app\modules\hosting\forms\mailbox\MailCreateForm;
use yii\base\Exception;

class MailboxController extends CommonController
{

    public function actionIndex()
    {
        $this->buttons[] = [
            'label' => Yii::t('hosting/default', 'BTN_MAILBOX_CREATE'),
            'url' => ['create'],
            'options' => ['class' => 'btn btn-success']
        ];
        $api = new Api('hosting_mailbox', 'info');


        $apiLimits = new Api('hosting_mailbox', 'limits');

        if ($api->response['status'] == 'success') {
            return $this->render('index', [
                'response' => $api->response['data'],
                'limits' => $apiLimits->response
            ]);
        } else {
            throw new Exception($api->response['message']);
        }
    }


    public function actionCreate()
    {
        $model = new MailCreateForm();

        $response = false;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $params['mailbox'] = $model->mailbox . $model->domain;
            $params['password'] = $model->password;
            $params['type'] = $model->type;
            $params['antispam'] = $model->antispam;

            if ($model->autoresponder) {
                $params['autoresponder']['enabled'] = $model->autoresponder;
                $params['autoresponder']['title'] = $model->autoresponder_title;
                $params['autoresponder']['text'] = $model->autoresponder_text;
            }
            if ($model->forward) {
                $params['forward'] = explode(',', $model->forward);
            }

            $api = new Api('hosting_mailbox', 'create', $params);




            if ($api->response['status'] == 'success') {
                $response = $api->response['data'];
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_MAILBOX_CREATE'));
            } else {
                Yii::$app->session->setFlash('danger', $api->response['message']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'response' => $response,
        ]);
    }

    public function actionEdit()
    {

        $this->buttons[] = [
            'label' => Yii::t('hosting/default', 'BTN_MAILBOX_CREATE'),
            'url' => ['create'],
            'options' => ['class' => 'btn btn-success']
        ];

        $model = new MailCreateForm();

        $response = false;
        $mailbox = Yii::$app->request->get('email');

        $api = new Api('hosting_mailbox', 'info', [
            'mailbox' => $mailbox
        ], true);

        if ($api->response['status'] == 'success') {
            $model->mailbox = $api->response['data']['name'];
            $model->password = $api->response['data']['password'];
            $model->type = $api->response['data']['type'];
            $model->antispam = $api->response['data']['autospam'];
            $model->forward = implode(',', $api->response['data']['forward']);
            $model->autoresponder = $api->response['data']['autoresponder']['enabled'];
            $model->autoresponder_title = $api->response['data']['autoresponder']['title'];
            $model->autoresponder_text = $api->response['data']['autoresponder']['text'];

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $params['mailbox'] = $model->mailbox;
                $params['password'] = $model->password;
                $params['type'] = $model->type;
                $params['antispam'] = $model->antispam;
                if ($model->autoresponder) {
                    $params['autoresponder']['enabled'] = $model->autoresponder;
                    $params['autoresponder']['title'] = $model->autoresponder_title;
                    $params['autoresponder']['text'] = $model->autoresponder_text;
                }
                if ($model->forward) {
                    $params['forward'] = explode(',', $model->forward);
                }

                $api = new Api('hosting_mailbox', 'edit', $params);

                if ($api->response['status'] == 'success') {
                    $response = $api->response['data'];
                    Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_MAILBOX_EDIT', ['email' => $model->mailbox]));
                } else {
                    Yii::$app->session->setFlash('danger', $api->response['message']);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'response' => $response,
        ]);
    }

    public function actionDelete()
    {
        if (Yii::$app->request->get('email')) {
            $api = new Api('hosting_mailbox', 'delete', [
                'mailbox' => Yii::$app->request->get('email'),
            ]);
            if ($api->response['status'] == 'success') {
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_MAILBOX_DELETE', ['email' => Yii::$app->request->get('email')]));
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка уделение почты');
            }
        }
        return $this->redirect(['index']);
    }

    public function actionClear()
    {
        if (Yii::$app->request->get('email')) {
            $api = new Api('hosting_mailbox', 'clear', [
                'mailbox' => Yii::$app->request->get('email'),
            ]);
            if ($api->response['status'] == 'success') {
                Yii::$app->session->setFlash('success', Yii::t('hosting/default', 'SUCCESS_MAILBOX_CLEAR', ['email' => Yii::$app->request->get('email')]));
            } else {
                Yii::$app->session->setFlash('danger', 'error databse_create');
            }
        }
        return $this->redirect(['index']);
    }

}
