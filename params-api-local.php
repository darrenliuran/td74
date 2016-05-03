<?php
/**
 * params-api-local.php file
 * User: LiuRan
 * Date: 2016/3/21 0021
 * Time: 上午 10:57
 */
return [
    /* 图片空间 */
    'photoSpace' => [
        'getList' => 'upload2.eastmachinery.com?action=group_photo',
        'getTotal' => 'upload2.eastmachinery.com?action=photo_count',
        'remove' => 'upload2.eastmachinery.com?action=photo_delete',
        'add' => 'upload2.eastmachinery.com?action=photo_add',
        'update' => 'upload2.eastmachinery.com?action=photo_name_update',
        'setCover' => 'upload2.eastmachinery.com?action=group_photo_cover',
        'getSize' => 'upload2.eastmachinery.com?action=space_size',
        'getGroupList' => 'upload2.eastmachinery.com?action=group_list',
        'getGroupDetail' => 'upload2.eastmachinery.com?action=photo_group_detail',
        'getGroupTotal' => 'upload2.eastmachinery.com?action=group_count',
        'addGroup' => 'upload2.eastmachinery.com?action=group_add',
        'updateGroup' => 'upload2.eastmachinery.com?action=group_update',
        'removeGroup' => 'upload2.eastmachinery.com?action=group_delete',
    ],
];