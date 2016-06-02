<?php

namespace backend\controllers\category;

use Yii;
use backend\models\goods\GoodsCategoryModel;

/**
 * GoodsController.php file
 * User: LiuRan
 * Date: 2016/5/16 0016
 * Time: 下午 1:01
 */
class GoodsController extends \backend\components\controllers\BKController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $goodsCategoryList = GoodsCategoryModel::getAll(NULL, 'child');

        return $this->render('index', [
            'goodsCategoryList' => $goodsCategoryList
        ]);
    }

    /**
     * 添加
     */
    public function actionAdd()
    {
        $categoryModel = new GoodsCategoryModel();

        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('GoodsCategoryModel');
            $data['parent_id'] = Yii::$app->request->post('parentId');
            $data['level'] = $data['parent_id'] > 0 ? 2 : 1;
            $categoryModel->attributes = $data;

            if ($categoryModel->save(TRUE))
            {
                Yii::$app->session->setFlash('successMessage', '添加分组成功');
            }
        }

        $categoryList = GoodsCategoryModel::getAll(0);

        return $this->render('add', [
            'categoryModel' => $categoryModel,
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * 更新
     */
    public function actionUpdate()
    {
        $id = intval(Yii::$app->request->get('id', 0));

        /** @var $categoryModel GoodsCategoryModel */
        $categoryModel = GoodsCategoryModel::findOne($id);

        if (Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post('GoodsCategoryModel');
            $data['parent_id'] = Yii::$app->request->post('parentId');
            $data['level'] = $data['parent_id'] > 0 ? 2 : 1;

            $categoryModel->attributes = $data;

            if ($categoryModel->save(TRUE))
            {
                Yii::$app->session->setFlash('successMessage', '编辑分组成功');
            }
        }

        $categoryList = GoodsCategoryModel::getAll(0);

        return $this->render('update', [
            'categoryModel' => $categoryModel,
            'categoryList' => $categoryList
        ]);
    }
}