<?php
    use yii\helpers\Url;
    use backend\components\constants\BKConstant;
?>
<!-- FooTable -->

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>用户管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?= Url::to(['/default']); ?>">首页</a>
            </li>
            <li>
                <a href="<?= Url::to(['/member/user']); ?>">用户管理</a>
            </li>
            <li class="active">
                <strong>列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <a href="#" class="btn btn-primary btn-sm pull-right m-t-lg">添加</a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
        <form action="<?= Url::to(['/member/user']) ?>" method="get">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" id="email" name="email" value="<?= isset($condition['email']) ? $condition['email'] : '' ?>" placeholder="邮箱" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <select name="state" id="state" class="form-control">
                            <option value="0">状态</option>
                            <?php foreach ($adminMemberState as $key => $state): ?>
                                <option value="<?= $key ?>" <?= isset($condition['state']) && $condition['state'] == $key ? 'selected' : '' ?>><?= $state ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-sm btn-primary" type="submit"><strong>搜索</strong></button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <table class="table table-stripped toggle-arrow-tiny">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>昵称</th>
                                <th data-hide="phone">真实姓名</th>
                                <th data-hide="phone" >邮箱</th>
                                <th data-hide="phone">状态</th>
                                <th class="text-right" data-sort-ignore="true">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($memberList) > 0): ?>
                                <?php foreach ($memberList as $member): ?>
                                    <tr>
                                        <td><?= $member['id'] ?></td>
                                        <td><?= $member['nick'] ?></td>
                                        <td><?= $member['name'] ?></td>
                                        <td><?= $member['email'] ?></td>
                                        <td>
                                            <span class="label <?= $member['state'] == BKConstant::AdminMemberStatusOpen ? 'label-primary': 'label-warning' ?>">
                                                <?= isset($adminMemberState[$member['state']]) ? $adminMemberState[$member['state']] : '' ?>
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <button class="btn-white btn btn-xs" data-toggle="modal" data-target="#update-modal">编辑</button>
                                                <button class="btn-white btn btn-xs">删除</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" align="center">暂无数据</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="footable-visible">
                                    <ul class="pagination pull-right">
                                        <li class="footable-page-arrow disabled">
                                            <a data-page="first" href="#first">«</a>
                                        </li>
                                        <li class="footable-page-arrow disabled">
                                            <a data-page="prev" href="#prev">‹</a>
                                        </li>
                                        <li class="footable-page active">
                                            <a data-page="0" href="#">1</a>
                                        </li>
                                        <li class="footable-page">
                                            <a data-page="1" href="#">2</a>
                                        </li>
                                        <li class="footable-page-arrow">
                                            <a data-page="next" href="#next">›</a>
                                        </li>
                                        <li class="footable-page-arrow">
                                            <a data-page="last" href="#last">»</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 编辑 -->
<div class="modal inmodal" id="update-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
                <form method="get" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Sample Input</label>
                        <div class="col-sm-6">
                            <input type="text" name="昵称" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>
