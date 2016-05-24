<?php

namespace common\models\area;

use Yii;

/**
 * This is the model class for table "td_area".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $code
 * @property integer $level
 * @property string $add_time
 * @property string $add_ip
 * @property string $update_time
 * @property string $update_ip
 */
class AreaModel extends \common\components\models\BSModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'td_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'add_time', 'update_time'], 'integer'],
            [['name', 'code'], 'string', 'max' => 32],
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
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'code' => 'Code',
            'level' => 'Level',
            'add_time' => 'Add Time',
            'add_ip' => 'Add Ip',
            'update_time' => 'Update Time',
            'update_ip' => 'Update Ip',
        ];
    }
}
