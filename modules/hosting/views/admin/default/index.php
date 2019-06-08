<?php

use panix\engine\Html;

echo Html::a('hosting_quota', ['/admin/hosting/hosting-quota'], ['class' => 'btn btn-secondary']);
echo Html::a('hosting_ftp', ['/admin/hosting/hosting-ftp'], ['class' => 'btn btn-secondary']);
echo Html::a('hosting_database', ['/admin/hosting/hosting-database'], ['class' => 'btn btn-secondary']);
echo Html::a('hosting_mailbox', ['/admin/hosting/hosting-mailbox'], ['class' => 'btn btn-secondary']);
echo Html::a('hosting_site', ['/admin/hosting/hosting-site'], ['class' => 'btn btn-secondary']);
echo Html::a('hosting_account', ['/admin/hosting/hosting-account'], ['class' => 'btn btn-secondary']);
echo Html::a('hosting_log', ['/admin/hosting/hosting-log'], ['class' => 'btn btn-secondary']);
echo Html::a('domain', ['/admin/hosting/domain'], ['class' => 'btn btn-secondary']);
echo Html::a('billing', ['/admin/hosting/billing'], ['class' => 'btn btn-secondary']);
echo Html::a('settings', ['/admin/hosting/settings'], ['class' => 'btn btn-success']);


echo '<br>';
echo Html::a('test #','#');
echo '<br>';
echo Html::a('test array',['http://adtest']);
echo '<br>';
echo Html::a('test http','http://pixelion.com.ua');
echo '<br>';
echo Html::a('test http addoptions "rel"','http://app2',['test'=>'dsa']);
echo '<br>';

echo Yii::$app->request->serverName;
if(strpos(Yii::$app->request->serverName,'app')===false){
    echo 'no';
}else{
    echo 'find';
}