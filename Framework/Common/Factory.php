<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 23:27
 */
namespace Common;

Class Factory {
    static function createDatabase(){
        $db = Database::getInstance();
        return $db;
    }
}