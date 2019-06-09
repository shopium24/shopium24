<?php

namespace app\modules\hosting\controllers\admin;

use Yii;
use yii\base\Exception;
use app\modules\hosting\components\Api;

class QuotaController extends CommonController
{

    public function actionIndex()
    {
        $api = new Api('hosting_quota', 'info');
        //$mysql = null;
        //$ftp = null;
        if ($api->response['status'] == 'success') {

            $ftp = Yii::$app->cache->get('hosting_quota_ftp');
            if ($ftp === false) {
                $ftpApi = new Api('hosting_quota', 'used_ftp');
                if ($ftpApi->response['status'] == 'success') {
                    Yii::$app->cache->set('hosting_quota_ftp', $ftpApi->response['data'], 0);
                }
            }


            $mysql = Yii::$app->cache->get('hosting_quota_mysql');
            if ($mysql === false) {
                $mysqlApi = new Api('hosting_quota', 'used_mysql');
                if ($mysqlApi->response['status'] == 'success') {
                    Yii::$app->cache->set('hosting_quota_mysql', $mysqlApi->response['data'], 0);
                }
            }

            return $this->render('index', [
                'response' => $api->response['data'],
                'mysql' => $mysql,
                'ftp' => $ftp
            ]);
        } else {
            throw new Exception($api->response['message']);
        }
    }

}
