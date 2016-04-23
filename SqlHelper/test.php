<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/27
 * Time: 20:12
 */

require_once('SqlHelper.php');
/**插入单条记录**/
//$data = [
//    'name'=>'李四',
//    'age'=>'321'
//];
//
//echo $sqlHelper->insert('student',$data);

/**插入多条记录**/
//$data = [
//    0=>[
//        'name'=>'zhangshan',
//        'age'=>'321'
//    ],
//    1=>[
//        'name'=>'王五',
//        'age'=>'321'
//    ],
//
//];
//echo $sqlHelper->inserts('student',$data);

/**修改记录**/
//$data = [
//    'name'=>'张山',
//    'age'=>'321'
//];
//$condition = 'id = 135 ';
//echo $sqlHelper->update('student',$data,$condition);

/**删除记录**/
//$condition = 'age = 321';
//echo $sqlHelper->delete('student',$condition);