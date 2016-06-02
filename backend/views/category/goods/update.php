<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!-- FooTable -->

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>分类管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= Url::to(['/default']); ?>">首页</a>
            </li>
            <li>
                <a href="<?= Url::to(['/category/goods']); ?>">分类管理</a>
            </li>
            <li class="active">
                <strong>更新</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row m-t">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title forum-info text-danger">
                <?= Yii::$app->session->getFlash('successMessage') ?>
            </div>
            <div class="ibox-content">
                <form id="category-form" action="<?= Url::to(['/category/goods/update', 'id' => $categoryModel->id]) ?>" method="post" class="form-horizontal">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">父级分类</label>
                        <div class="col-sm-2">
                            <select class="form-control m-b" name="parentId">
                                <option value="0">顶级分类</option>
                                <?php if (count($categoryList) > 0): ?>
                                    <?php foreach ($categoryList as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= $categoryModel->parent_id == $category['id'] ? 'selected="selected"' : '' ?>><?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类名称</label>
                        <div class="col-sm-4">
                            <?= Html::activeInput('text', $categoryModel, 'name', ['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-2">
                            <?= Html::activeInput('text', $categoryModel, 'sort', ['class' => 'form-control']) ?>
                            <span class="help-block m-b-none">数值越大越靠前</span>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
