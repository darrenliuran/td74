<?php

namespace backend\controllers\member;

/**
 * UserController.php file
 * User: LiuRan
 * Date: 2016/5/10 0010
 * Time: 下午 7:00
 */
class UserController extends \backend\components\controllers\BKController
{
    /**
     * 首页
     */
    public function actionIndex()
    {

        return $this->render('index');
    }
}