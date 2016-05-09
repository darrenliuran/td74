<?php

namespace backend\controllers;

use yii;

/**
 * DefaultController.php file
 * 首页
 * User: LiuRan
 * Date: 2016/5/9 0009
 * Time: 下午 3:53
 */
class DefaultController extends \backend\components\controllers\BKController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        echo 'default-index';
    }
}