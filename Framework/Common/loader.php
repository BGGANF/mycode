<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 21:32
 */
namespace Common;

Class Loader {
    static function autoload($class){
        require_once BASE_DIR.'/'.str_replace('\\','/',$class).'.php';
    }
}