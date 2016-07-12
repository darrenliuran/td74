<?php

namespace common\models\news;

use Yii;

/**
 * This is the model class for table "{{%news_category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property integer $type
 * @property integer $level
 * @property string $sort
 * @property string $add_time
 * @property string $add_ip
 * @property string $update_time
 * @property string $update_ip
 */
class NewsCategoryModel extends \common\components\models\BSModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'type', 'level', 'sort', 'add_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 64],
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
            'type' => 'Type',
            'level' => 'Level',
            'sort' => 'Sort',
            'add_time' => 'Add Time',
            'add_ip' => 'Add Ip',
            'update_time' => 'Update Time',
            'update_ip' => 'Update Ip',
        ];
    }

    /**
     * 获取所有分类
     * @param null $parentId
     * @param bool|FALSE $isFormat
     * @return array
     */
    public static function getAll($parentId = NULL, $isFormat = FALSE)
    {
        $query = self::find();

        if (!is_null($parentId))
        {
            $query->andWhere('parent_id = '.$parentId);
        }

        $query->orderBy('parent_id ASC, sort DESC');

        $groupList = $query->asArray()->all();

        if ($isFormat === 'list')
        {
            $groupList = self::_formatList($groupList);
        }
        else if($isFormat === 'child')
        {
            $groupList = self::_formatChild($groupList);
        }

        return $groupList;
    }

    /**
     * 格式化分组为列表
     */
    private static function _formatList($groupList)
    {

    }

    /**
     * 格式化分组为子分组
     * @param $groupList
     * @return array
     */
    private static function _formatChild($groupList)
    {
        $format = [];

        if (count($groupList) > 0)
        {
            foreach ($groupList as $group)
            {
                if ($group['level'] == 1)
                {
                    $format[$group['id']] = $group;
                }
                else
                {
                    if (!isset($format[$group['parent_id']]['childList']))
                    {
                        $format[$group['parent_id']]['childList'] = [$group];
                    }
                    else
                    {
                        array_push($format[$group['parent_id']]['childList'], $group);
                    }
                }
            }
        }

        return $format;
    }
}
