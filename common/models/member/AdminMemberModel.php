<?php

namespace common\models\member;

use Yii;

/**
 * This is the model class for table "{{%admin_member}}".
 *
 * @property string $id
 * @property string $nick
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $state
 * @property integer $login_time
 * @property integer $add_time
 * @property string $add_ip
 * @property integer $update_time
 * @property string $update_ip
 */
class AdminMemberModel extends \common\components\models\BSModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state', 'login_time', 'add_time', 'update_time'], 'integer'],
            [['nick', 'name'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 128],
            [['email'], 'unique', 'message' => '邮箱已存在'],
            [['password'], 'string', 'max' => 32],
            [['add_ip', 'update_ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nick' => 'Nick',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'state' => 'State',
            'login_time' => 'Login Time',
            'add_time' => 'Add Time',
            'add_ip' => 'Add Ip',
            'update_time' => 'Update Time',
            'update_ip' => 'Update Ip',
        ];
    }
}
