<?php
//setcookie("testName1",'testValue1',time()+3600);
//setcookie("testName2",'testValue2222',time()+3600);
//setcookie("testName3",'testValue3',time()+3600);
//setcookie("testName4",'testValue4',time()+3600);

//if(isset($_COOKIE['testName1'])){
//    echo $_COOKIE['testName1'];
//}else{
//    echo '没有cookie';
//}

//echo $_COOKIE['testName1'] . "<br>";
//echo $_COOKIE['testName2'] . "<br>";
//echo $_COOKIE['testName3'] . "<br>";
//echo $_COOKIE['testName4'];

//unset($_COOKIE['testName1']);
//setcookie('testName1','testValue1',time()-1);

//输入两个时间戳，计算差值，也就是相差的小时数，如返回2:10，则表示输入的两个时间相差2小时10分钟
function hours_min($start_time,$end_time){
    if (strtotime($start_time) > strtotime($end_time)) list($start_time, $end_time) = array($end_time, $start_time);
    $sec = $start_time - $end_time;
    $sec = round($sec / 60);
    $min = str_pad($sec % 60, 2, 0, STR_PAD_LEFT);
    $hours_min = floor($sec / 60);
    $min != 0 && $hours_min .= ':'.$min;
    return $hours_min;
}
$tomorrow = strtotime(date('Y-m-d',strtotime('+1 day')));          //明天零点的时间戳

$todaytime  = time();

//echo $tomorrow - $todaytime;
//
////exit;
//
//echo "明天:".date("Y-m-d",$tomorrow-$todaytime). "<br>";
//
//echo hours_min($tomorrow,time());

$today=time();//
$tomorrowtime=strtotime(date('Y-m-d',strtotime('+1 day')));
$exptime=$tomorrowtime-$today;
echo $exptime;exit;