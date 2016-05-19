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
                <a href="<?= Url::to(['/category/manage']); ?>">分类管理</a>
            </li>
            <li class="active">
                <strong>列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="<?= Url::to(['/category/manage/add']) ?>" class="btn btn-primary btn-sm pull-right m-t-lg">添加</a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
        <form action="<?= Url::to(['/category/manage']) ?>" method="get">
            <div class="row">

            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><small></small></h5>
                </div>
                <div class="ibox-content">
                    <div id="jstree">
                        <?php if (count($goodsCategoryList) > 0): ?>
                        <ul>
                            <?php foreach ($goodsCategoryList as $goodsCategory): ?>
                                <li class="jstree-open">
                                    <?= $goodsCategory['name'] ?>
                                    <?php if (isset($goodsCategory['childList'])): ?>
                                        <ul>
                                            <?php foreach ($goodsCategory['childList'] as $item): ?>
                                                <li data-jstree='{"type":"child"}'>
                                                    <?= $item['name'] ?>
                                                    <div class="btn-group" style="float:right">
                                                        <button class="btn-white btn btn-xs" data-toggle="modal" data-target="#update-modal">编辑</button>
                                                        <button class="btn-white btn btn-xs">删除</button>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        ssss
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= Yii::$app->params['jsUrl'] ?>/plugins/jsTree/jstree.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#jstree').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'child' : {
                    'icon' : 'fa fa-file-code-o'
                }
            }
        });
    });
</script>