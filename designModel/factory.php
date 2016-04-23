<?php
/** *工厂方法模式* 
*定义一个用于创建对象的接口,让子类决定将哪一个类实例化,使用一个类的实例化延迟到其子类
*/ 
/*
classDBFactory{ 
	public static function create($type){
		swtich($type){ 
			case"Mysql":
 				return new MysqlDB();
 				break;
			case"Postgre":
 				return new PostgreDB();
 				break;
			case"Mssql":
 				return new MssqlDB();
 				break;
 		}
	}
}*/

class DBFactory{ 
	public static function create($type) { 
		$class = $type."DB";
		return new $class; 
	}
} 
interface DB{ 
	public function connect();
	public function exec();
} 
class MysqlDB implements DB{ 
	public function __construct(){
		echo "mysqldb<br/>"; 
	} 
	public function connect(){
	 } 
	public function exec(){ 
	}
}
class MysqliDB implements DB{
	public function __construct(){
		echo "mysqlidb<br/>";
	}
	public function connect(){
	}
	public function exec(){
	}
}
class PostgreDB implements DB{ 
	public function __construct(){
		echo "Postgredb<br/>"; 
	} 
	public function connect(){

	}
	 public function exec(){ 

	}
} 
class MssqlDB implements DB{
    public function __construct(){ 
    	echo "mssqldb<br/>";
    } 
    public function connect(){ 

    } 
    public function exec(){ 

    }
}

$Mysql = DBFactory::create("Mysql");

