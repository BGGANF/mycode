<?php
/**
 * Created by PhpStorm.
 * User: FuChuan
 * Date: 2016/3/30
 * Time: 17:03
 */

Class Response {

    /**
     *���ۺϷ�ʽ���ͨ������
     *@param integer $code ״̬��
     *@param string $message ��ʾ��Ϣ
     *@param array $data ����
     *@param string $type ��������
     *@return string
     */
    public static function show($code,$message='',$data=array(),$type){
        if(!is_numeric($code)){		//�жϴ�������$code�Ƿ�������
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
            //TODO ����
        }
    }

    /**
     *��json��ʽ���ͨ������
     *@param integer $code ״̬��
     *@param string $message ��ʾ��Ϣ
     *@param array $data ����
     *@return string
     */
    public static function json($code,$message = '',$data = array()){
        if(!is_numeric($code)){		//�жϴ�������$code�Ƿ�������
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
     *��xml��ʽ���ͨ������
     *@param integer $code ״̬��
     *@param string $message ��ʾ��Ϣ
     *@param array $data ����
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