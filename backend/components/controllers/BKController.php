<?php

namespace backend\components\controllers;

use yii;
use yii\helpers\Url;

/**
 * BKController.php file
 * User: LiuRan
 * Date: 2016/5/6 0006
 * Time: 下午 1:06
 */
class BKController extends \common\components\controllers\BSController
{
    /**
     * 初始化
     */
    public function init()
    {
        parent::init();

        if (Yii::$app->user->isGuest)
        {
            $this->redirect(Url::to(['/login']));
        }
    }
}