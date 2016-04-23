<?php  
/**
 * 二维数组根据某个字段排序 
 * 功能：按照用户的年龄倒序排序 
 * @author ruxing.li 
 */  
header('Content-Type:text/html;Charset=utf-8');  
$arrUsers = array(  
    array(  
            'id'   => 1,  
            'name' => '张三',  
            'age'  => 25,  
    ),  
    array(  
            'id'   => 2,  
            'name' => '李四',  
            'age'  => 23,  
    ),  
    array(  
            'id'   => 3,  
            'name' => '王五',  
            'age'  => 40,  
    ),  
    array(  
            'id'   => 4,  
            'name' => '赵六',  
            'age'  => 31,  
    ),  
    array(  
            'id'   => 5,  
            'name' => '黄七',  
            'age'  => 20,  
    ),  
);   
  
  
$sort = array(  
        'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
        'field'     => 'age',       //排序字段  
);  
//$arrSort = array();
//foreach($arrUsers AS $uniqid => $row){
//    foreach($row AS $key=>$value){
//        $arrSort[$key][$uniqid] = $value;
//    }
//}
//if($sort['direction']){
//    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arrUsers);
//}
//
//var_dump($arrUsers);


function mySort($arrUsers,$sort){
    $arrSort = array();
    foreach($arrUsers AS $uniqid => $row){
        foreach($row AS $key=>$value){
            $arrSort[$key][$uniqid] = $value;
        }
    }
    if($sort['direction']){
        array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arrUsers);
    }
    return $arrUsers;
}


var_dump(mySort($arrUsers,$sort));



















