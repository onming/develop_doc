<?php

class User extends App_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取短信验证码
     * @desc 用于获取用户登录注册短信验证码
     * @param string mobile 1 130123456758 接受验证码手机号
     * @param string app_id 1 login        短信验证码类型(login|bind|register)
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    function smsCode()
    {
        echo json_encode(array('status' => 0, 'msg' => '网络异常'));
    }

    /**
     * 短信验证码登录
     * @desc 使用短信验证码来登录APP
     * @param string mobile true 130123456758 登录手机号
     * @param string code   true 123456       短信验证码
     * @param string device_id false 123456 设备ID
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string token 令牌
     * @return string isRegister 是否为注册 1为注册
     * @return string msg 提示信息
     * @
     */
    function codeLogin()
    {
        echo json_encode(array('status' => 0, 'msg' => '您的验证码有误，请确认后再试'));
    }

    /**
     * 留存测试接口
     * @desc 用于测试用户接口使用
     */
    public function testing($method = '')
    {
//        // 判断非生成环境才能访问
//        if (is_production_env()) {
//            exit();
//        }

        if ($method) {
            switch ($method) {
                case 'smsCode':
                    $_POST = array(
                        'mobile' => '13763826870',
                        'app_id' => 'login',
                    );
                    break;

                case 'codeLogin':
                    $_POST = array(
                        'mobile' => '13763826870',
                        'code' => '123456',
                        'device_id' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                    );
                    break;
            }

            $_POST = array_merge($_POST, $_GET);

            $_POST['unique'] = '13763826870';
            $_POST['timestamp'] = time();
            $_POST['random'] = rand(100000, 999999);
            $_POST['sign'] = ci_md5($_POST['unique'] . $_POST['timestamp'] . $_POST['random']);

            $this->$method();
        }
        $this->_resultJson(array('status' => 0, 'msg' => '服务器繁忙请稍后重试'));
    }
}
