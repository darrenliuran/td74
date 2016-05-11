<?php

namespace backend\models\member;

/**
 * AdminMemberModel.php file
 * User: LiuRan
 * Date: 2016/5/6 0006
 * Time: 下午 12:58
 */
class AdminMemberModel extends \common\models\member\AdminMemberModel
{
    /**
     * 获取列表
     * @param array $condition
     * @param string $order
     * @param array $pages
     * @return array
     */
    public static function getList($condition = [], $order = '', $pages = [])
    {
        $query = self::find();

        if (isset($condition['email']) && !empty($condition['email']))
        {
            $query->andWhere('email = :email', [':email' => $condition['email']]);
        }

        if (isset($condition['state']) && $condition['state'] > 0)
        {
            $query->andWhere('state = :state', [':state' => $condition['state']]);
        }

        $total = $query->count();

        $order = !empty($order) ? $order : 'id DESC';
        $query->orderBy($order);

        if (isset($pages['page']) && isset($pages['pageSize']))
        {
            $query->limit($pages['pageSize'])->offset(($pages['page'] - 1) * $pages['pageSize']);
        }

        $list = $query->asArray()->all();

        return [$list, $total];
    }
}