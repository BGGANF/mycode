<?php

$value = isset($_GET['value']) ? $_GET['value'] : $_POST['value'];
if($value != null){
    $data = [
        'status'=>1,
        'msg'=>'传入成功'
    ];
}else{
    $data = [
        'status'=>1,
        'msg'=>'传入失败'
    ];
}
$jsonData = json_encode($data);
echo $jsonData;