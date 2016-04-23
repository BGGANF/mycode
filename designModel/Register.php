<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/4/8
 * Time: 14:27
 */
Class Register {
    protected static $objects;

    public static function set($alias,$object){
        self::$objects[$alias] = $object;
    }

    public function get($name){
        return self::$objects[$name];
    }

    function _unset($alias){
        unset(self::$objects[$alias]);
    }
}
