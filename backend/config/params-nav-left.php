<?php

use yii\helpers\Url;

/**
 * params-nav-left.php file
 * 左侧导航
 * User: LiuRan
 * Date: 2016/6/2 0002
 * Time: 下午 12:40
 */
return [
    'navLeft' => [
        'system' => [
            'name' => '系统',
            'icon' => 'fa-windows',
            'childList' => [
                ['name' => 'Dashboard v.1', 'url' => '#']
            ]
        ],
        'member' => [
            'name' => '会员',
            'icon' => 'fa-child',
            'childList' => [
                ['name' => '用户管理', 'url' => Url::to('/member/user/index')]
            ]
        ],
        'category' => [
            'name' => '分类',
            'icon' => 'fa-align-justify',
            'childList' => [
                ['name' => '产品分类', 'url' => Url::to('/category/goods/index')],
                ['name' => '文章分类', 'url' => Url::to('/category/news/index')]
            ]
        ],
    ]
];