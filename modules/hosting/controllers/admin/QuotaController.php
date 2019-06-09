<?php

namespace app\modules\hosting\controllers\admin;

use app\modules\hosting\components\Api;
use yii\base\Exception;

class QuotaController extends CommonController
{

    public function actionIndex()
    {
        $api = new Api('hosting_quota', 'info');
        $mysql = null;
        $ftp = null;
        if ($api->response['status'] == 'success') {
            $ftpApi = new Api('hosting_quota', 'used_ftp');
            if ($ftpApi->response['status'] == 'success') {
                $ftp = $ftpApi->response['data'];
            }

            $mysqlApi = new Api('hosting_quota', 'used_mysql');
            if ($mysqlApi->response['status'] == 'success') {
                $mysql = $mysqlApi->response['data'];
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
