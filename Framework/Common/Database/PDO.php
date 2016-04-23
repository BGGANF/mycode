<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 23:56
 */
namespace Common\Database;

use Common\IDatabase;

Class PDO implements IDatabase{
    private $conn;
    function connect($host,$user,$password,$dbname){
        $conn = new \PDO("mysql:host=$host;dbname=$dbname",$user,$dbname);
        $this->conn = $conn;
    }

    function query($sql){
        return $this->query($sql);
    }

    function close(){
        unset($this->conn);
    }
}