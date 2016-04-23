<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/24
 * Time: 9:30
 */

require_once('SqlHelper.php');

$act = isset ($_GET['act']) ? trim ($_GET['act']) : '';
if ($act == 'del') {
    $parent_id = isset ($_GET['id']) ? intval($_GET['id']) : '0' ;
    $parent_ids = $parent_id;
    $childrenIds = $sqlHelper->getChildrenIds($parent_id);
    if (!empty ($childrenIds)) {
        $parent_ids .= $childrenIds;
    }
    print_r($parent_ids);
    $sql = "delete from `book_category` WHERE `parent_id` in ({$parent_ids})";
    $res = $sqlHelper->execute($sql) ;
    if ($res > 0) {
        echo '删除成功';
        exit;
    }
    else {
        echo '删除失败';
        exit;
    }
}




