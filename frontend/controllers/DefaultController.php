<?php

namespace frontend\controllers;

/**
 * DefaultController.php file
 * User: LiuRan
 * Date: 2016/5/5 0005
 * Time: 上午 8:33
 */
class DefaultController extends \yii\web\Controller
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        echo 'default-index';
    }
}