<?php

/* Include debug functions */
require_once(__DIR__.'/functions.php');

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/_db.php';
$smtp = require __DIR__ . '/_smtp.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower'   => '@vendor/bower-asset',
        '@npm'     => '@vendor/npm-asset',
        '@prodImg' => '/img/products'
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'AbsXCIJgJCNRbn0xM2GHQmgv0dT5xFRF',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => 'user/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => $smtp,
            //'useFileTransport' => true,,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'yii_stand_log' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        '\app\components\exceptions\CustomException::*',
                    ],
                ],
                /*'yii_stand_mail' => [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'logVars' => [],
                    'except' => [
                        '\app\components\exceptions\CustomException::*',
                    ],
                    'message' => [
                        'from' => ['al-loco@mail.ru'],
                        'to' => ['al-loco@mail.ru'],
                        'subject' => 'YII_ERROR: websymbol.ru',
                    ],

                ],*/
                'exception_info' => [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/exception_info.log',
                    'logVars' => [],
                    'levels' => ['info'],
                    'categories' => [
                        'app\components\exceptions\CustomException::infoExcept'
                    ]
                ],
                'exception_warning' => [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/exception_warning.log',
                    'logVars' => [],
                    'levels' => ['warning'],
                    'categories' => [
                        'app\components\exceptions\CustomException::warningExcept'
                    ]
                ],
                'exception_error' => [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/exception_error.log',
                    'logVars' => [],
                    'levels' => ['error'],
                    'categories' => [
                        'app\components\exceptions\CustomException::errorExcept'
                    ]
                ],
                'exception_error_send_mail' => [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'logVars' => [],
                    'categories' => [
                        'app\components\exceptions\CustomException::errorExcept'
                    ],
                    'message' => [
                        'from' => ['al-loco@mail.ru'],
                        'to' => ['al-loco@mail.ru'],
                        'subject' => 'ERROR: websymbol.ru',
                    ],
                ],

            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(index|about|contact|login|logout|category|product-detail)>' => 'site/<action>',
                '<module:(admin)>/<controller:(order)>' => '<module>/<controller>/orders',
            ],
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => 	'/var/lib/php/sessions_yiishop',
            'cookieParams' => ['lifetime' => 7 * 24 *60 * 60],
            'timeout' => 7 * 24 *60 * 60,
            'useCookies' => true,
        ],
    ],

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin_main',
            'defaultRoute' => 'order/orders',
        ],
    ],

    'params' => $params,

];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['109.252.93.55', '::1', '109.252.93.11', '::1', '109.252.57.61', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['109.252.93.55', '::1', '109.252.93.11', '::1', '109.252.57.61', '::1'],
    ];
    // asset cashe for dev
    //$config['components']['assetManager']['forceCopy'] = true;
}

return $config;
