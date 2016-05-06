<?php

namespace backend\components;

use yii;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/9
 * Time: 15:50
 */
class WebUser extends \yii\web\User
{
    /**
     * 获取店铺Id
     */
    public function getUserId()
    {
        return Yii::$app->user->identity->getId();
    }
}