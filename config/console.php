<?php

return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'sitemap' => [
            'class' => 'panix\mod\sitemap\console\CreateController',
        ],
        'migrate' => ['class' => 'panix\engine\console\controllers\MigrateController',
            //'migrationPath' => '@console/migrations',
            'migrationNamespaces' => [
                //  'console\migrations',
                // 'lo\plugins\migrations',
                //'app\migrations',
                // 'yii\rbac\migrations'
            ],
            'migrationPath' => ['@app/migrations', '@yii/rbac/migrations'], //,'@vendor/panix/mod-rbac/migrations'
        ]
    ],
    'components' => [
        'request' => [
            'class' => 'yii\console\Request',
        ],
    ],
    'params' => require(__DIR__ . '/../config/params.php'),
];
