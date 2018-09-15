<?php
use app\controllers\SiteController;
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'task' => ['class' => \app\modules\task\TaskModule::class],
        'project' => ['class' => \app\modules\project\ProjectModule::class],
        'user' => ['class' => \app\modules\user\UserModule::class]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'r3qpbfppq2pv3v3vmaa1kxyqh5hagdtc24',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //todo move to module.
                'POST api/v1/projects' => 'project/api/create',
                'GET api/v1/projects/<id>' => 'project/api/get',
                'GET api/v1/projects' => 'project/api/get',
                'PATCH api/v1/projects/<id>' => 'project/api/update',
                'DELETE api/v1/projects/<id>' => 'project/api/drop',

                'POST api/v1/projects/<id>/task' => 'task/api/create',
                'GET api/v1/tasks/<id>' => 'task/api/get',
                'GET api/v1/projects/<id>/tasks' => 'project/api/get-tasks-by-project-id',
                'PATCH api/v1/tasks/<id>' => 'task/api/update',
                'DELETE api/v1/tasks/<id>' => 'task/api/drop',


                // BASIC AUTH without refresh token. Todo make refresh token.
                'POST /api/v1/login' => 'user/api/login',
                'POST api/v1/signup' => 'user/api/signup',
            ],
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
