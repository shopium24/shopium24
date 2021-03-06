<?php


error_reporting(E_ALL);
//Timezone
date_default_timezone_set("UTC");

// comment out the following two lines when deployed to production
if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1','178.212.194.135'])) {
    $env = 'dev';
    $debug = true;
} else {
    $env = 'prod';
    $debug = false;

}
defined('COMMON_PATH') or define('COMMON_PATH', dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'common');
defined('YII_DEBUG') or define('YII_DEBUG', $debug);
defined('YII_ENV') or define('YII_ENV', $env);

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../vendor/autoload.php');
//$config = require(__DIR__ . '/config/web.php');


$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../config/common.php',
    require __DIR__ . '/../config/web.php'
);

//use yii\web\Application;


$app = new \panix\engine\WebApplication($config);
$app->run();
