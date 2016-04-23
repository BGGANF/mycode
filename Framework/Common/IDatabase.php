<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/22
 * Time: 0:21
 */
namespace Common;

interface IDatabase{
    function connect($host,$user,$password,$dbname);
    function query($sql);
    function close();
}