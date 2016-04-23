<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 22:15
 */
namespace Common;

interface IDatabase{
    function connect($host,$user,$password,$dbname);
    function query($sql);
    function close();
}

Class Database {
    private $db;
    function __construct(){

    }
    //单例模式：使某个类的对象仅允许被创建一次
    static function getInstance(){
        if(self::$db){
            return self::$db;
        }else{
            self::$db = new self();
            return selt::$db;
        }
    }

    function where($where){
        return $this;
    }

    function order($order){
        return $this;
    }

    function limit($limit){
        return $this;
    }
}