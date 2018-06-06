<?php

class Account extends App_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 账户信息
     * @desc 账户信息
     * @param string token 1 MSxhc2QhQCNmZ2gkJV5qa2wmKig  令牌
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    public function index()
    {
        echo json_encode(array('status' => 0, 'msg' => '网络异常'));
    }

    /**
     * 实名认证
     * @desc 实名认证
     * @param string token 1 MSxhc2QhQCNmZ2gkJV5qa2wmKig  令牌
     * @param string mobile 1 130123456758 实名认证手机号
     * @param string idcard 1 130123456758 身份证号
     * @param string realname   1 123456 真实姓名
     * @param string app_id 1 android 保留字段
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    function certification()
    {
        echo json_encode(array('status' => -9, 'msg' => '请先登录后再访问'));
    }

    /**
     * 绑定微信账号
     * @desc 绑定微信账号
     * @param string token true MSxhc2QhQCNmZ2gkJV5qa2wmKig  令牌
     * @param string account_wx true 123456 绑定微信账号
     * @param string app_id true android 保留字段
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    function bind_wx()
    {
        echo json_encode(array('status' => -9, 'msg' => '请先登录后再访问'));
    }

    /**
     * 提现
     * @desc 提现操作
     * @param string token true MSxhc2QhQCNmZ2gkJV5qa2wmKig  令牌
     * @param string amount true 0.01 提现金额
     * @param string mode false wx 提现渠道，当前只有微信,保留字段
     * @param string app_id false android 保留字段
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    function withdraw()
    {
        echo json_encode(array('status' => 1, 'msg' => '提现成功'));
    }

    /**
     * 提现流水
     * @desc 提现流水
     * @param string token 1 MSxhc2QhQCNmZ2gkJV5qa2wmKig  令牌
     * @param string page_index 1 1 第几页
     * @param string page_size  1 10 每页条数
     * @param string app_id 1 android 保留字段
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    function withdraw_bill()
    {
        echo json_encode(array('status' => -9, 'msg' => '请先登录后再访问'));
    }

    public function testing($method = '')
    {
//        // 判断非生成环境才能访问
//        if (is_production_env()) {
//            exit();
//        }

        if ($method) {
            switch ($method) {
                case 'index':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'app_id' => 'ios',
                    );
                    break;

                case 'certification':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'mobile' => '13888888888',
                        'idcard' => '350111112121212',
                        'realname' => 'onming',
                        'app_id' => 'ios',
                    );
                    break;

                case 'bind_wx':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'account_wx' => '13888888888',
                        'app_id' => 'ios',
                    );
                    break;

                case 'withdraw':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'amount' => '0.01',
                        'mode' => 'wx',
                        'app_id' => 'ios',
                    );
                    break;

                case 'withdraw_bill':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'page_index' => '1',
                        'page_size' => '10',
                        'app_id' => 'ios',
                    );
                    break;
            }


            $_POST['unique'] = '13763826870';
            $_POST['timestamp'] = time();
            $_POST['random'] = rand(100000, 999999);
            $_POST['sign'] = ci_md5($_POST['unique'] . $_POST['timestamp'] . $_POST['random']);

            $this->$method();
        }
        echo json_encode(array('status' => 0, 'msg' => '服务器繁忙请稍后重试'));
    }
}
