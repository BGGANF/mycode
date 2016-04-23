<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 23:56
 */
namespace Common\Database;

use Common\IDatabase;

Class MySQL implements IDatabase {
    private $conn;
    function connect($host,$user,$password,$dbname){
        $conn = mysql_connect($host,$user,$password);
        mysql_select_db($dbname,$conn);
        $this->conn = $conn;
    }

    function query($sql){
        $res = mysql_query($sql,$this->conn);
        return $res;
    }

    /**
     * 获取多行记录，succes返回一个多维数组，error 返回 false
     * @param $sql
     * @return array
     */
    function getRows($sql){
        $res = mysql_query($sql,$this->conn);
        $rows = array();
        while($row = mysql_fetch_array($res)){
             array_push($rows, $row);
        }
        return $rows;
    }

    /**
     * 获取一行记录，succes返回一个一维的索引数组，error 返回 false
     * @param $sql
     * @return array
     */
    function getRow($sql){
        $res = mysql_query($sql,$this->conn);
        $row = mysql_fetch_array($res);
        return $row;
    }

    /**
     * 获取一行记录，succes返回一个关联数组，error 返回 false
     * @param $sql
     * @return array
     */
    function getAssoc($sql){
        $res = mysql_query($sql,$this->conn);
        $assoc = mysql_fetch_assoc($res);
        return $assoc;
    }

    /**
     * 关闭连接
     */
    function close(){
        mysql_close($this->conn);
    }
}