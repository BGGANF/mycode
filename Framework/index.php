<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 21:28
 */

define('BASE_DIR',__DIR__);
include BASE_DIR.'/Common/Loader.php';
spl_autoload_register('\\Common\\Loader::autoload');

//Common\Object::test();
//App\Controller\Home\Index::index();

//$db = new Common\Database();
//$db = Common\Database::getInstance();

//$db->where("id=1")->order("name=2")->order("id desc")->limit(10);
//$db->where("id=1");
//$db->where("name=2");
//$db->order("id desc");
//$db->limit(10);

//$obj = new Common\Object();
//$obj->title = 'zhangshan';
//echo $obj->title;
//echo $obj->test('Hello world',123);
//echo $obj::test('Hello World',123);

error_reporting(E_ALL ^ E_DEPRECATED);
//适配器模式
$db = new Common\Database\MySQLi();
$db->connect('localhost','root','wing-root','mycode');
$object = $db->getObject("select *from tb_user where name = 'zhangshan'");
var_dump($object);


