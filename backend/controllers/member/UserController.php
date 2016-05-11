<?php

namespace backend\controllers\member;

use Yii;
use backend\models\member\AdminMemberModel;

/**
 * UserController.php file
 * User: LiuRan
 * Date: 2016/5/10 0010
 * Time: 下午 7:00
 */
class UserController extends \backend\components\controllers\BKController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $condition = [
            'email' => Yii::$app->request->get('email', ''),
            'state' => intval(Yii::$app->request->get('state', 0)),
        ];

        $pages = [
            'page' => intval(Yii::$app->request->get('page', 1)),
            'pageSize' => Yii::$app->params['pageSize']
        ];

        list($memberList, $total) = AdminMemberModel::getList($condition, '', $pages);


        return $this->render('index', [
            'memberList' => $memberList,
            'condition' => $condition,
            'adminMemberState' => Yii::$app->params['adminMemberState']
        ]);
    }
}