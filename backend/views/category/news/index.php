<?php
use yii\helpers\Url;
use backend\components\constants\BKConstant;
?>
<link href="<?= Yii::$app->params['cssUrl'] ?>/plugins/jsTree/style.min.css" rel="stylesheet">
<style type="text/css">
    .jstree-open > .jstree-anchor > .fa-folder:before {
        content: "\f07c";
    }

    .jstree-default .jstree-icon.none {
        width: 0;
    }
</style>
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
                <strong>列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?= Url::to(['/category/news/add']) ?>" class="btn btn-primary btn-sm pull-right m-t-lg">添加</a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5></h5>
                </div>
                <div class="ibox-content">
                    <div class="dd" id="nestable">
                        <?php if (count($goodsCategoryList) > 0): ?>
                            <ol class="dd-list">
                                <?php foreach ($goodsCategoryList as $goodsCategory): ?>
                                    <?php if (!isset($goodsCategory['childList'])): ?>
                                        <li class="dd-item" data-id="1">
                                            <div class="dd-handle">
                                                <?= $goodsCategory['name'] ?>

                                                <div class="btn-group" style="float:right;">
                                                    <a href="<?= Url::to(['category/news/update', 'id' => $goodsCategory['id']]) ?>" class="btn-white btn btn-xs">编辑</a>
                                                    <a href="javascript:void(0);" data-request-url="<?= Url::to(['category/news/remove', 'id' => $goodsCategory['id']]) ?>" class="btn-white btn btn-xs remove-btn">删除</a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php else: ?>
                                        <li class="dd-item" data-id="2">
                                            <div class="dd-handle">
                                                <?= $goodsCategory['name'] ?>

                                                <div class="btn-group" style="float:right;">
                                                    <a href="<?= Url::to(['category/news/update', 'id' => $goodsCategory['id']]) ?>" class="btn-white btn btn-xs">编辑</a>
                                                    <a href="javascript:void(0);" data-request-url="<?= Url::to(['category/news/remove', 'id' => $goodsCategory['id']]) ?>" class="btn-white btn btn-xs remove-btn">删除</a>
                                                </div>
                                            </div>
                                            <ol class="dd-list">
                                                <?php foreach ($goodsCategory['childList'] as $item): ?>
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                            <?= $item['name'] ?>

                                                            <div class="btn-group" style="float:right;">
                                                                <a href="<?= Url::to(['category/news/update', 'id' => $item['id']]) ?>" class="btn-white btn btn-xs">编辑</a>
                                                                <a href="javascript:void(0);" data-request-url="<?= Url::to(['category/news/remove', 'id' => $item['id']]) ?>" class="btn-white btn btn-xs remove-btn">删除</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ol>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Nestable List -->
<script src="<?= Yii::$app->params['jsUrl'] ?>/plugins/nestable/jquery.nestable.js"></script>
<script type="text/javascript">
//    $(document).ready(function(){
//        $('#nestable').nestable({
//            group: 3
//        });
//    });

    //$('.btn-group')
</script>