<?php

Class Response {

	public static function xml(){
		$xml = "<?xml version='1.0' encoding='UTF-8?>\n";
		$xml .= "<root>\n";
		$xml .= "<code>200</code>\n";
		$xml .= "<message>数据返回成功</message>\n";
		$xml .= "<data>\n";
		$xml .= "<id>1</id>\n";
		$xml .= "<name>pengfuchuan</name>\n";
		$xml .= "</data>\n";
		$xml .= "</root>";

		echo $xml;
	}

	/**
	*按xml方式输出通信数据
	*@param integer $code 状态码
	*@param string $message 提示信息
	*@param array $data 数据
	*@return string 
	*/
	public static function xmlEncode($code,$message,$data = array()){
		if(!is_numeric($code)){
			return '';
		}

		$result = array(
			'code'    => $code,
			'message' => $message,
			'data'    => $data
		);
//		header("Content-Type:text/xml");
		$xml = "<?xml version='1.0' encoding='UTF-8?>\n";
		$xml .= "<root>\n";
		$xml .= self::xmlToEncode($data);
		$xml .= "</root>";

		echo $xml;
	}

	public static function xmlToEncode($data){
		$xml = "";
		foreach ($data as $key => $value) {
			$xml .= "<{$key}>";
			$xml .= $value;
			$xml .= "</{$key}>\n";
		}
		return $xml;
	}

}

//测试数据

// Response::xml();

$data = [
	'id'=>1,
	'name'=>'pengfuchaun',
];

Response::xmlEncode(200,'success',$data);



















