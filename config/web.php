<?php

//Yii::setAlias('@runtime', '@webroot/web/runtime');

Yii::setAlias('@console', dirname(__DIR__) . '/../console/web');

$config = [
    'id' => 'web',
    'homeUrl' => '/',
   // 'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'panix\engine\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => [
        'plugins',
        'panix\engine\plugins\goaway\GoAway',
        'panix\engine\widgets\webcontrol\WebInlineControl',
    ],
    'controllerMap' => [
        'site' => 'panix\engine\controllers\WebController',
    ],
    'components' => [
        'consoleRunner' => [
            'class' => 'panix\engine\components\ConsoleRunner',
            'file' => '@my/path/to/yii' // or an absolute path to console file
        ],
        'plugins' => [
            'class' => 'panix\mod\plugins\components\PluginsManager',
            'appId' => panix\mod\plugins\BasePlugin::APP_WEB,
            // by default
            'enablePlugins' => true,
            'shortcodesParse' => true,
            'shortcodesIgnoreBlocks' => [
                '<pre[^>]*>' => '<\/pre>',
                '<a[^>]*>' => '<\/a>',
                // '<div class="content[^>]*>' => '<\/div>',
            ]
        ],
        'fcm' => [
            'class' => 'understeam\fcm\Client',
            'apiKey' => 'AIzaSyAbeTCpxK7OGu_lXZDSnJjV1ItkUwPOBbc', // Server API Key (you can get it here: https://firebase.google.com/docs/server/setup#prerequisites)
        ],
        'stats' => ['class' => 'panix\mod\stats\components\Stats'],
        'geoip' => ['class' => 'panix\engine\components\geoip\GeoIP'],
        //'webcontrol' => ['class' => 'panix\engine\widgets\webcontrol\WebInlineControl'],
        'view' => [
            'class' => 'app\engine\View',
            'as Layout' => [
                'class' => 'panix\engine\behaviors\LayoutBehavior',
            ],
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\smarty\ViewRenderer',
                ],
            ],
            'theme' => [
                'class' => 'panix\engine\base\Theme'
            ],
        ],
        'request' => [
            'class' => 'panix\engine\WebRequest',
            'baseUrl' => '',
            // 'csrfParam' => '_csrf-frontend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fpsiKaSs1Mcb6zwlsUZwuhqScBs5UgPQ',
        ],

        'errorHandler' => [
            //'class'=>'panix\engine\base\ErrorHandler'
            //'errorAction' => 'site/error',
            'errorAction' => 'site/error',
            // 'errorView' => '@webroot/themes/basic/views/layouts/error.php'
        ],


        'urlManager' => require(__DIR__ . '/urlManager.php'),

    ],
    //'on beforeRequest' => ['class' => 'panix\engine\base\ThemeView']
    /*'as access' => [
        'class' => panix\mod\rbac\filters\AccessControl::class,
        'allowActions' => [
            '/*',
            'admin/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],*/

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['modules']['debug']['class'] = 'yii\debug\Module';
    // $config['modules']['debug']['traceLine'] = '<a href="phpstorm://open?url={file}&line={line}">{file}:{line}</a>';
    $config['modules']['debug']['traceLine'] = function ($options, $panel) {
        $filePath = $options['file'];
        // $filePath = str_replace(Yii::$app->basePath, 'file://~/path/to/your/backend', $filePath);
        // $filePath = str_replace(dirname(Yii::$app->basePath) . '/common', 'file://~/path/to/your/common', $filePath);
        /// $filePath = str_replace(Yii::$app->vendorPath, 'file://~/path/to/your/vendor', $filePath);
        return strtr('<a href="phpstorm://open?url={file}&line={line}">{file}:{line}</a>', ['{file}' => $filePath]);
    };
    $config['modules']['debug']['panels'] = [
        // 'queue' => \yii\queue\debug\Panel::class,
    ];
    //$config['modules']['debug']['dataPath'] = '@runtime/debug';
    //$config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
