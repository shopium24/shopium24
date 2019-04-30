<?php

return [
    'id' => 'console',
    'name' => 'PIXELION CMS',
    'basePath' => dirname(__DIR__),
    //'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'panix\engine\BootstrapModule'],
    'controllerNamespace' => 'app\commands',
    'language' => 'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads',
    ],
    'modules' => [
        'plugins' => [
            'class' => 'panix\mod\plugins\Module',
            'pluginsDir' => [
                '@panix/engine/plugins',
                // '@plugins/core',
            ]
        ],
        'sitemap' => [
            'class' => 'panix\mod\sitemap\Module',
        ],
        'rbac' => [
            'class' => 'panix\mod\rbac\Module',
            //'as access' => [
            //    'class' => panix\mod\rbac\filters\AccessControl::class
            //],
        ],
        'admin' => ['class' => 'panix\mod\admin\Module'],
        'user' => ['class' => 'shopium24\mod\user\Module'],
        'plans' => ['class' => 'shopium24\mod\plans\Module'],
        'hosting' => ['class' => 'app\modules\hosting\Module'],
        'seo' => ['class' => 'panix\mod\seo\Module'],
        'pages' => ['class' => 'panix\mod\pages\Module'],
        'contacts' => ['class' => 'panix\mod\contacts\Module'],
    ],
    'controllerMap' => [
        'sitemap' => [
            'class' => 'panix\mod\sitemap\console\CreateController',
        ],
        'migrate' => ['class' => 'panix\engine\console\controllers\MigrateController',
            //'migrationPath' => '@console/migrations',
            // 'migrationNamespaces' => [
            //  'console\migrations',
            // 'lo\plugins\migrations',
            // ],
        ]
    ],
    'components' => [
        //'session' => [
        //    'class' => 'yii\web\Session'
        // ],

        'urlManager' => require(__DIR__ . '/urlManager.php'),
        'settings' => ['class' => 'panix\engine\components\Settings'],
        'cache' => ['class' => 'yii\caching\FileCache'],
        'languageManager' => ['class' => 'panix\engine\ManagerLanguage'],
        //'urlManager' => require(__DIR__ . '/urlManager.php'),
        'db' => require(__DIR__ . '/../config/db.php'),
    ],
    'params' => require(__DIR__ . '/../config/params.php'),
];
