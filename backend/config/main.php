<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php'),
    require(__DIR__ . '/params-nav-left.php'),
    require(__DIR__ . '/../../common/config/dict.php'),
    require(__DIR__ . '/dict.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'default/index',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // 按需调整这里
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout'
            ],
        ],
        'user' => [
            'identityClass' => 'backend\components\WebUser',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
