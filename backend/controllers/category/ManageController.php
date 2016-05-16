<?php

namespace backend\controllers\category;

/**
 * ManageController.php file
 * User: LiuRan
 * Date: 2016/5/16 0016
 * Time: 下午 1:01
 */
class ManageController extends \backend\components\controllers\BKController
{
    /**
     * 首页
     */
    public function actionIndex()
    {

        return $this->render('index');
    }
}