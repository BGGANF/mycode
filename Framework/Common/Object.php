<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 21:28
 */
namespace Common;

Class Object{
//    static function test(){
//        echo 'object test'."<br>";
//    }

    private $array = array();

    function __set($key,$value){
        var_dump(__METHOD__);
        $this->array[$key] = $value;
    }

    function __get($key){
        var_dump(__METHOD__);
        return $this->array[$key];
    }

    function __call($func,$param){
        var_dump($func,$param);
        return "magic function"."<br>";
    }

    static function __callStatic($func,$param){
        var_dump($func,$param);
        return "magic static function"."<br>";
    }
}