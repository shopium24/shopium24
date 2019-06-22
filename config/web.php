<?php

Yii::setAlias('@console', dirname(__DIR__) . '/../console/web');

$config = [
    'id' => 'app',
    'name' => 'PIXELION CMS',
    'homeUrl' => '',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'panix\engine\controllers',
    'defaultRoute' => 'main/main',
    'bootstrap' => [
        'log',
        'maintenanceMode',
        'panix\engine\BootstrapModule'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@uploads' => '@app/web/uploads',
    ],
    'controllerMap' => [
        'main' => 'panix\engine\controllers\WebController',
        'backend' => 'panix\engine\controllers\AdminController',
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
        'seo' => ['class' => 'panix\mod\seo\Module'],
        'user' => ['class' => 'shopium24\mod\user\Module'],
        'plans' => ['class' => 'shopium24\mod\plans\Module'],
        'hosting' => ['class' => 'app\modules\hosting\Module'],
        'pages' => ['class' => 'panix\mod\pages\Module'],
        'contacts' => ['class' => 'panix\mod\contacts\Module'],
    ],
    'components' => [
        'plugins' => [
            'class' => panix\mod\plugins\components\PluginsManager::class,
            'appId' => panix\mod\plugins\BasePlugin::APP_FRONTEND,
            // by default
            'enablePlugins' => true,
            'shortcodesParse' => true,
            'shortcodesIgnoreBlocks' => [
                '<pre[^>]*>' => '<\/pre>',
                '<a[^>]*>' => '<\/a>',
               // '<div class="content[^>]*>' => '<\/div>',
            ]
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'panix\engine\widgets\recaptcha\ReCaptcha',
            'siteKey' => '6LfJqpYUAAAAAMKYmNUctjXeTkQrx74R2LHaM0r7',
            'secret' => '6LfJqpYUAAAAAGOItZcYABLTjDilBvgaAJE7vJL0',
        ],
        'img' => [
            'class' => 'panix\engine\components\ImageHandler',
        ],

        'robotsTxt' => [
            'class' => 'app\modules\sitemap\RobotsTxt',
            'userAgent' => [
                // Disallow url for all bots
                '*' => [
                    'Disallow' => [
                        ['/api/default/index'],
                    ],
                    'Allow' => [
                        ['/api/doc/index'],
                    ],
                ],
                // Block a specific image from Google Images
                'Googlebot-Image' => [
                    'Disallow' => [
                        // All images on your site from Google Images
                        '/',
                        // Files of a specific file type (for example, .gif)
                        '/*.gif$',
                    ],
                ],
            ],
        ],
        'sitemap' => [
            'class' => 'app\modules\sitemap\Sitemap',
            'models' => [
                // your models
                'app\modules\news\models\News',
                // or configuration for creating a behavior
                [
                    'class' => 'app\modules\news\models\News',
                    'behaviors' => [
                        'sitemap' => [
                            'class' => '\app\modules\sitemap\behaviors\SitemapBehavior',
                            'scope' => function ($model) {
                                /** @var \yii\db\ActiveQuery $model */
                                $model->select(['url', 'lastmod']);
                                $model->andWhere(['is_deleted' => 0]);
                            },
                            'dataClosure' => function ($model) {
                                /** @var self $model */
                                return [
                                    'loc' => \yii\helpers\Url::to($model->url, true),
                                    'lastmod' => strtotime($model->lastmod),
                                    'changefreq' => \app\modules\sitemap\Sitemap::DAILY,
                                    'priority' => 0.8
                                ];
                            }
                        ],
                    ],
                ],
            ],
            'urls' => [
                // your additional urls
                [
                    'loc' => ['/news/default/index'],
                    //'changefreq' => \app\modules\sitemap\Sitemap::DAILY,
                    'priority' => 0.8,
                    'news' => [
                        'publication' => [
                            'name' => 'Example Blog',
                            'language' => 'en',
                        ],
                        'access' => 'Subscription',
                        'genres' => 'Blog, UserGenerated',
                        'publication_date' => 'YYYY-MM-DDThh:mm:ssTZD',
                        'title' => 'Example Title',
                        'keywords' => 'example, keywords, comma-separated',
                        'stock_tickers' => 'NASDAQ:A, NASDAQ:B',
                    ],
                    'images' => [
                        [
                            'loc' => 'http://example.com/image.jpg',
                            'caption' => 'This is an example of a caption of an image',
                            'geo_location' => 'City, State',
                            'title' => 'Example image',
                            'license' => 'http://example.com/license',
                        ],
                    ],
                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours,
            'sortByPriority' => true, // default is false
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=127.0.0.1;port=9306;',
            'username' => '',
            'password' => '',
        ],
        'fcm' => [
            'class' => 'understeam\fcm\Client',
            'apiKey' => 'AIzaSyAbeTCpxK7OGu_lXZDSnJjV1ItkUwPOBbc', // Server API Key (you can get it here: https://firebase.google.com/docs/server/setup#prerequisites)
        ],
        'formatter' => [
            'class' => 'panix\engine\i18n\Formatter'
        ],
        'assetManager' => [
            'forceCopy' => YII_DEBUG,
            // 'basePath'=>'@webroot/web/assets',
            'bundles' => [
                //'yii\jui\JuiAsset' => ['css' => []],
                'yii\jui\JuiAsset' => [
                    //'js' => [
                    //'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js'
                    //]
                ],
                'panix\lib\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyB5BYRPxlqTN9GwnZHQbmW-eJxT7ZxyAfM',
                        'language' => 'ru',
                        'version' => '3.39'
                    ]
                ]
            ],
            //'linkAssets' => true,
            'appendTimestamp' => true
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/panix/engine/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/admin' => 'admin.php',
                        'app/month' => 'month.php',
                        'app/error' => 'error.php',
                        'app/geoip_country' => 'geoip_country.php',
                        'app/geoip_city' => 'geoip_city.php',
                    ],
                ],
            ],
        ],
        'session' => [
            'class' => '\panix\engine\web\DbSession',
            'timeout' => 1440
            //'class' => '\yii\web\DbSession',
            //'writeCallback'=>['panix\engine\web\DbSession', 'writeFields']
        ],
        'request' => [
            'class' => 'panix\engine\WebRequest',
            'baseUrl' => '',
            //'csrfParam' => '_csrf-backend',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fpsiKaSs1Mcb6zwlsUZwuhqScBs5UgPQ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache', //DummyCache
            // 'cachePath' => '@common/runtime/cache'
        ],
        'user' => [
            'class' => 'shopium24\mod\user\components\WebUser',
            'enableAutoLogin' => true,
            // 'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'mailer' => [
            'class' => 'panix\engine\Mailer',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/' . date('Y-m-d') . '/db.log',
                    'categories' => ['yii\db\*']
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'logFile' => '@runtime/logs/' . date('Y-m-d') . '/warning.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@runtime/logs/' . date('Y-m-d') . '/info.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['profile'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/' . date('Y-m-d') . '/profile.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/' . date('Y-m-d') . '/trace.log',
                ],
                [
                    'class' => 'panix\engine\log\EmailTarget',
                    'levels' => ['error', 'warning'],
                    'enabled' => false,//YII_DEBUG,
                    'categories' => ['yii\base\*'],
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\web\HttpException:400',
                        'yii\i18n\PhpMessageSource::loadMessages'
                    ],
                    /*'message' => [
                        'from' => ['log@pixelion.com.ua'],
                        'to' => ['dev@pixelion.com.ua'],
                        'subject' => 'Ошибки базы данных на сайте app',
                    ],*/
                ],
                /*[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'logTable' => '{{%log_error}}',
                    'except' => [
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\web\HttpException:400',
                        'yii\i18n\PhpMessageSource::loadMessages'
                    ],
                ],*/
            ],
        ],
        'curl' => ['class' => 'panix\engine\Curl'],
        'languageManager' => ['class' => 'panix\engine\ManagerLanguage'],
        'settings' => ['class' => 'panix\engine\components\Settings'],
        'maintenanceMode' => [
            'class' => 'panix\engine\maintenance\MaintenanceMode',
            // Allowed roles
            //'roles' => [
            //    'admin',
            //],
            //Retry-After header
            // 'retryAfter' => 120 //or Wed, 21 Oct 2015 07:28:00 GMT for example
        ],
        'consoleRunner' => [
            'class' => 'panix\engine\components\ConsoleRunner',
            'file' => '@my/path/to/yii' // or an absolute path to console file
        ],
        'stats' => ['class' => 'panix\mod\stats\components\Stats'],
        'geoip' => ['class' => 'panix\engine\components\geoip\GeoIP'],
        'webcontrol' => ['class' => 'panix\engine\widgets\webcontrol\WebInlineControl'],
        'view' => [
            'class' => \panix\mod\plugins\components\View::class,
            'as Layout' => [
                'class' => \panix\engine\behaviors\LayoutBehavior::class,
            ],
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\smarty\ViewRenderer',
                ],
            ],
            'theme' => ['class' => 'panix\engine\base\Theme'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'urlManager' => require(__DIR__ . '/urlManager.php'),
        'db' => require(__DIR__ . '/db.php'),

    ],
    'params' => require(__DIR__ . '/params.php'),
    /*'as access' => [
        'class' => panix\mod\rbac\filters\AccessControl::class,
        'allowActions' => [
            '/*',
            //'admin/*',
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
    //$config['modules']['debug']['dataPath'] = '@runtime/debug';
    //$config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
