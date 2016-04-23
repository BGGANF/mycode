<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/17
 * Time: 14:22
 */

/**
 * mysql数据库操作类
 */

require_once('config/main-local.php');
class SqlHelper {
    private $mysqli;
    private $host;
    private $user;
    private $pwd;
    private $dbname;
    private $charset;
    public function __construct($config){
        $this->host    = $config['db']['host'];
        $this->user    = $config['db']['user'];
        $this->pwd     = $config['db']['pwd'];
        $this->dbname  = $config['db']['dbname'];
        $this->charset = $config['db']['charset'];
        //完成初始化任务
        $this->mysqli = new mysqli($this->host,$this->user,$this->pwd,$this->dbname);
        //connect_error代表mysqli面向对象实例 的属性
        if($this->mysqli->connect_error){
            die("连接失败".$this->mysqli->connect_error);
        }
        //设置访问数据库的字符集
        $this->mysqli->query("set names $this->charset");
    }

    /**
     *执行sql语句
     * @param $sql
     * @return int
     */
    public function execute($sql){
        $res = $this->mysqli->query($sql) or die('Error: sql执行失败 ' . $this->mysqli_error);
        if(!$res){
            return 0;                                   //表示失败
        }else{
            if($this->mysqli->affected_rows > 0){
                return $res;
            }else{
                return -1;
            }
        }
    }

    /**
     * 获取多行记录，成功返回一个二维数组
     * @param $sql
     * @return array|int
     */
    public function getRows($sql){
        $res = $this->mysqli->query($sql) or die('Error: sql执行失败 ' . $this->mysqli_error);
        if(!$res){
            return 0;                                  //表示失败
        }else{
            if($this->mysqli->affected_rows > 0){
                $arr = [];
                while($row = $res->fetch_array(MYSQL_ASSOC)){
                    array_push($arr,$row);
                }
                return $arr;                           //表示成功,返回数组
            }else{
                return -1;                             //表示没有行受到影响
            }
        }
    }

    /**
     * 成功返回一条记录并且是关联数组的形式
     * @param $sql
     * @return mixed
     */
    public function getOneAssoc($sql){
        $res = $this->mysqli->query($sql) or die('Error: sql执行失败 ' . $this->mysqli_error);
        if(!$res){
            return 0;                                  //表示失败
        }else{
            if($this->mysqli->affected_rows > 0){
                $arr = $res->fetch_assoc();
                return $arr;                           //表示成功,返回数组
            }else{
                return -1;                             //表示没有行受到影响
            }
        }

    }

    /**
     * 成功返回一条记录并且是索引数组的形式
     * @param $sql
     * @return mixed
     */
    public function getOneRow($sql){
        $res = $this->mysqli->query($sql) or die('Error: sql执行失败 ' . $this->mysqli_error);
        if(!$res){
            return 0;                                  //表示失败
        }else{
            if($this->mysqli->affected_rows > 0){
                $arr = $res->fetch_row();
                return $arr;                           //表示成功,返回数组
            }else{
                return -1;                             //表示没有行受到影响
            }
        }
    }

    /**
     * 插入单条记录,成功返回受影响的行数，失败返回false
     * @param $table_name
     * @param $data         example   $data = ['name'  => 'zhangshan','email' => '123@qq.com',]
     * @return int
     */
    public function insert($table_name,$data){
        $keys = implode(',',array_keys($data));
        $values = "'" . implode("','",array_values($data)) . "'";
        $sql = "INSERT INTO {$table_name}($keys) VALUES($values)";
        if(!$this->mysqli->query($sql)){
            return false;
        }
        return $this->affected_rows();
    }

    /**
     * 插入多条记录，成功返回受影响的总行数，失败返回false
     * @param $table_name
     * @param $data array   example  $data=[0=>['name'=>'xiaobai','age'=>'18'],1=>['name'=>'xiaobai','age'=>'18']]
     * @return bool|int
     */
    public function inserts($table_name,$data){
        $flag = true;
        $num = 0;
//        $this->mysqli->begin_transaction();     //开启事务
        foreach($data as $v){
            $keys = implode(',',array_keys($v));
            $values = "'" . implode("','",array_values($v)) . "'";
            $sql = "INSERT INTO {$table_name}($keys) VALUES($values)";
            if(!$this->mysqli->query($sql)){
                $flag = false;
            }
            $num++;
        }
        if($flag){
            $this->mysqli->commit();          //如果都插入成功则提交事务，return 受影响行数
            return $num;
        }else{
            $this->mysqli->rollback();        //如果其中有一条失败则回滚，return false
            return false;
        }
    }

    /**
     * 修改记录，修改成功返回受影响的行数，失败返回false
     * @param $table_nam
     * @param $data       example    $data = ['name'=>'zhangshan','age'=>18];
     * @param $condition  example    $condition = 'id=126' or 'id=16 and age=18'...
     * @return bool|int
     */
    public function update($table_nam,$data,$condition){
        $keys = array_keys($data);
        $values = array_values($data);

        $tempArr = array();
        $x = '';
        for($i = 0; $i < count($keys);$i++){
            $str =  $keys[$i] . '=' . "'" . $values[$i] . "',";
            $x .= $str;
        }
        $newstr = substr($x,0,strlen($x)-1);
        $sql = 'update ' . $table_nam . ' set ' . $newstr . ' where ' . $condition ;
        $this->mysqli->query($sql);
        if($this->affected_rows()){
            return $this->affected_rows();
        }else{
            return false;
        }
    }

    /**
     * 删除记录，成功返回受影响的行数，失败返回false
     * @param $table_name
     * @param $condition   example    $condition = 'id=126' or 'id=16 and age=18'...
     * @return bool|int
     */
    public function delete($table_name,$condition){
        $sql = 'delete from ' .$table_name . ' where ' . $condition;
        $this->mysqli->query($sql);
        if($this->affected_rows()){
            return $this->affected_rows();
        }else{
            return false;
        }
    }

    /**
     * 返回受影响的行数
     * @return int
     */
    public function affected_rows(){
        return $this->mysqli->affected_rows;
    }

    /**
     * 关闭连接
     */
    public function close(){
        $this->mysqli->close();
    }

    /**
    * 获取无限分类ID下面的子类ID集
    * $parent_id = $parent_id.getChildrenIds($parent_id);
    * $sql = " ….. where parent_id in ($parent_id)";
    **/
    function getChildrenIds ($parent_id) {
        $ids = '';
        $sql = "SELECT * FROM book_category  WHERE `parent_id` = '{$parent_id}'";
        $res = $this->mysqli->query($sql);
        if ($res) {
            while ($row = $res->fetch_assoc()) {
                $ids .= ','.$row['id'];
                $ids .= $this->getChildrenIds ($row['id']);
            }
        }
        return $ids;
    }

}

$sqlHelper = new SqlHelper($config);


//$data = [
//    0=>['name'=>'user23'],
//    1=>['name'=>'user24'],
//    2=>['name'=>'user25'],
//    3=>['name'=>'user26'],
//    4=>['name'=>'user27'],
//    5=>['name'=>'user28'],
//    6=>['name'=>'user29'],
//    7=>['name'=>'user30'],
//    8=>['name'=>'user31'],
//    9=>['name'=>'user32'],
//    10=>['name'=>'user33'],
//];
//$sqlHelper->inserts('page',$data);