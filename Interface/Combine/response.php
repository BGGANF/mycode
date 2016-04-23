<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/30
 * Time: 17:03
 */

Class Response {

    /**
     *按综合方式输出通信数据
     *@param integer $code 状态码
     *@param string $message 提示信息
     *@param array $data 数据
     *@param string $type 数据类型
     *@return string
     */
    public static function show($code,$message='',$data=array(),$type){
        if(!is_numeric($code)){		//判断传过来的$code是否是数字
            return '';
        }
        $result = array(
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        );
        if($type == 'json'){
            self::json($code,$message,$data);
            exit;
        }elseif($type == 'xml'){
            self::xmlEncode($code,$message,$data);
            exit;
        }elseif($type == 'array'){
            var_dump($result);
        }else{
            //TODO 其他
        }
    }

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

$data = array(
    'id'=>1,
    'name'=>'pfc',
    'type'=>array(4,5,6),
);

Response::show(200,'success',$data,'json');