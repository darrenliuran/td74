<?php

namespace backend\components;

use backend\models\member\IdentityMemberModel;
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
     * 获取用户Id
     */
    public function getUserId()
    {
        return Yii::$app->user->identity->getId();
    }

    /**
     * 用户身份
     * @param $id
     * @return null|static
     */
    public static function findIdentity($id)
    {
        return IdentityMemberModel::findOne($id);
    }
}