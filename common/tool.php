<?php
namespace app\common;

class Tool  
{
    protected static $error_msg;

    /**
     * 统一的接口输入
     * @dates  2015-11-12
     * @author wangyafei
     * @param  integer    $code 错误代码
     * @param  array      $data 返回数据
     * @param  integer    $type 返回类型 1:object 2:array 3:json
     * @param  string     $msg  自定义返回信息
     * @return mixed             
     */
    static public function commonDataInput($code,$data='',$type=3,$msg='')
    {
        $is_legal   = is_int($code) ? true : false;
        if (!$is_legal) {
            $return = array('errorcode'=>10,'msgs'=>'穿入的code有误');
        } else {
            $msg    = empty($msg) ? Tool::getErrorMsg($code) : $msg;
            $return['errorcode'] = $code;
            $return['msgs']      = $msg;
            if ((0  == $code) && !empty($data)) {
                $return['data']  = $data;
            }
        }
        if (1 == $type) {//对象
            return arrayToObject($return);
        } elseif(2 == $type) {//数组
            return $return;
        }else {//默认json格式
            echo json_encode($return);
        }
        
    }
    
    /**
     * 获取错误信息
     * @dates  2015-11-12
     * @author wangyafei
     * @param  integer     $code 错误代码
     * @return mixed             array|boolean
     */
    public static function getErrorMsg ($code)
    {
        $error_msg = Tool::getInitErrorMsg();
        $key = 'msg_'.$code;
        if (array_key_exists($key, $error_msg)) {
            return $error_msg[$key];
        } else {
            return false;
        }
    }

    /**
     * 参数信息配置
     * @dates  2015-11-12
     * @author wangyafei
     * @return array     
     */
    public static function getInitErrorMsg ()
    {
        return array(
            'msg_0'=>'ok',
            'msg_1'=>'参数不正确',
            'msg_2'=>'参数缺失',
            'msg_3'=>'找不到数据',
            'msg_4'=>'数据已经存在',
            'msg_5'=>'非法操作',
            'msg_6'=>'未知错误',
            'msg_7'=>'非法请求',
            'msg_8'=>'自定义请求',
        );
    }

}
   

