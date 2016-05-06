<?php

namespace common\components\controllers;

use yii;

/**
 * BSController.php file
 * 基控制器
 * User: LiuRan
 * Date: 2016/5/6 0006
 * Time: 下午 12:46
 */
class BSController extends \yii\web\Controller
{
    public $userId = 0;       // 用户ID

    public function init()
    {
        parent::init();

        $this->userId = Yii::$app->user->id;
    }
}