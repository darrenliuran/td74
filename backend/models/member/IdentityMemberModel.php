<?php

namespace backend\models\member;

use yii;
use common\components\helpers\BSHelper;

/**
 * IdentityMemberModel.php file
 * 用户身份
 * User: LiuRan
 * Date: 2016/5/9 0009
 * Time: 下午 1:56
 */
class IdentityMemberModel extends \common\models\member\AdminMemberModel implements \yii\web\IdentityInterface
{
    /**
     * 根据id获取用户信息
     * @param $id
     * @return null|static
     */
    public static function getInfoById($id)
    {
        return self::findOne($id);
    }

    /**
     * 通过email或nick + passwd 获取用户
     * @param $username
     * @return $this
     */
    public static function getInfoByUsername($username)
    {
        if (preg_match(Yii::$app->params['emailPattern'], $username))
        {
            $memberModel = self::find()->where("email = :username", [':username' => $username])->one();
        }
        else
        {
            $memberModel = self::find()->where("nick = :username", [':username' => $username])->one();
        }

        return $memberModel;
    }

    /**
     * 通过email获取用户数据
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findByEmail($email)
    {
        return self::find()->where('email = :email', [':email' => $email])->one();
    }

    /**
     * 根据给到的ID查询身份。
     *
     * @param string|integer $id 被查询的ID
     * @return IdentityInterface|null 通过ID匹配到的身份对象
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 根据 token 查询身份。
     *
     * @param string $token 被查询的 token
     * @return IdentityInterface|null 通过 token 得到的身份对象
     */
    public static function findIdentityByAccessToken($token, $type = NULL)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string 当前用户ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string 当前用户的（cookie）认证密钥
     */
    public function getAuthKey()
    {
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 商家登录
     * @param $username
     * @param $password
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findByUsernamePassword($username, $password)
    {
        $query = self::find();
        $query->where('nick=:username or email = :username or mobile= :username', [':username' => $username]);
        $query->andWhere('password = :password', [':password' => BSHelper::encryptionPassword($password)]);

        return $query->one();
    }
}