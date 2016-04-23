<?php 

Class Response {

	/**
	*按json方式输出通信数据
	*@param integer $code 状态码
	*@param string $message 提示信息
	*@param array $data 数据
	*@return string 
	*/
	public static function json($code,$message = '',$data = array()){
		if(!is_numeric($code)){		//判断传过来的$code是否是数字
			return '';
		}

		$result = array(
			'code'    => $code,
			'message' => $message,
			'data'    => $data
		);	

		echo json_encode($result);
	}
}

//测试数据
$arr = [
	'id'=>1,
	'name'=>'pfc'
];

Response::json(200,'数据返回成功',$arr);