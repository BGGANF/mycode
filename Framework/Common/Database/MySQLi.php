<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/21
 * Time: 23:56
 */
namespace Common\Database;

use Common\IDatabase;

Class MySQLi implements IDatabase{
    private $conn;

    public function connect($host, $user, $password, $dbname)
    {
        $conn = mysqli_connect($host,$user,$password,$dbname);
        if(!$conn){
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $this->conn = $conn;
    }

    function query($sql){
        return mysqli_query($this->conn,$sql);
    }

    /**
     * 获取多行记录，成功返回一个二维数组
     * @param $sql
     * @return array|int
     */
    public function getRows($sql){
        $res = mysqli_query($this->conn,$sql);
        $rows = array();
        while($row = $res->fetch_array()){
            array_push($rows, $row);
        }
        return $rows;
    }

    /**
     * 获取一行记录，找到记录返回一个一维的索引数组，没找到返回false
     * @param $sql
     * @return mixed
     */
    public function getRow($sql){
        $res = mysqli_query($this->conn,$sql);
        if(!$res) return false;
        $row = $res->fetch_array();
        if($row == null && empty($row)) return false;
        return $row;
    }

    /**
     * 获取一行记录，找到记录返回一个一维的关联数组，没找到返回false
     * @param $sql
     * @return array|bool
     */
    public function getAssoc($sql){
        $res = mysqli_query($this->conn,$sql);
        if(!$res) return false;
        $assoc = $res->fetch_assoc();
        if($assoc == null && empty($assoc)) return false;
        return $assoc;
    }
    /**
    * 获取对象数组
    * @param $sql
    * @return object|bool
    */
    public function getObject($sql){
        $res = mysqli_query($this->conn,$sql);
        if(!$res) return false;
        if($res->num_rows == 1){    
            $assoc = $res->fetch_assoc();
            if($assoc == null && empty($assoc)) return false;
            return (object)$assoc;
        }else{ 
            $rows = array();
            while($row = $res->fetch_assoc()){
                array_push($rows, (object)$row);
            }
            return (object)$rows;
        }
    }

    public function close(){
        mysqli_close($this->conn);
    }

}
