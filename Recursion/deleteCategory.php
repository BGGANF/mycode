<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/24
 * Time: 9:30
 */

$act = isset ($_GET['act']) ? trim ($_GET['act']) : '';
if ($act == 'del') {
    $sort_id = isset ($_GET['id']) ? intval($_GET['id']) : '0' ;
    $sort_ids = $sort_id;
    $childrenIds = getChildrenIds ($sort_id);
    if (!empty ($childrenIds)) {
        $sort_ids .= $childrenIds;
    }
    $sql = "delete from `article_sort` WHERE `sort_id` in ({$sort_ids})";
    $res = mysql_query ($sql);
    if ($res) {
        alert ('删除成功');
        exit;
    }
    else {
        alert ('删除失败');
        exit;
    }
}

/*—————————————————— */
//– 获取无限分类ID下面的子类ID集
//– $sort_id = $sort_id.getChildrenIds($sort_id);
//– $sql = " ….. where sort_id in ($sort_id)";
/*—————————————————— */
function getChildrenIds ($sort_id) {
    global $db;
    $ids = '';
    $sql = "SELECT * FROM ".$db->table('article_sort')." WHERE `parent_id` = '{$sort_id}'";
    $res = $db->query ($sql);
    if ($res) {
        while ($row = $db->fetch_assoc ($res)) {
            $ids .= ','.$row['sort_id'];
            $ids .= getChildrenIds ($row['sort_id']);
        }
    }
    return $ids;
}