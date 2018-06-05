<?php

class Gateway extends App_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * 版本
     * @desc 获取版本
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return int version_code 版本号
     * @return string version_name 版本名称
     * @return string download 下载地址
     * @return int constraint 是否强制更新
     * @return string note 提示信息
     * @
     */
    public function version()
    {
        $result = array(
            'status' => 1,
            'version_code' => 1,
            'version_name' => '1.2',
            'download' => '',
            'constraint' => 1,
            'note' => '',
        );
        echo json_encode($result);
    }

    /**
     * 消息
     * @desc 获取消息
     * @param string token true 130123456758 令牌
     * @param string type  true home|system|activity 取值类型
     * @param string message_id false 1001 消息ID
     * @param string page_index false 1 第几页
     * @param string page_size  false 10 每页条数
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return object message 排行榜列表
     * @return string msg 提示信息
     * @
     */
    public function message()
    {
        echo json_encode(array('status' => 0, 'msg' => '请先登录后再访问'));
    }

    /**
     * 消息读取
     * @desc 获取消息
     * @param string token 1 130123456758 令牌
     * @param string message_id  1 1001|all 消息ID
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return string msg 提示信息
     * @
     */
    public function message_read()
    {
        echo json_encode(array('status' => 0, 'msg' => '请先登录后再访问'));
    }

    /**
     * 首页数据
     * @desc 获取首页信息
     * @param string token 1 130123456758 令牌
     * @param string type  1 recommend|new 取值类型
     * @param string page_index 1 1 第几页
     * @param string page_size  1 10 每页条数
     * @return int status 操作码，1表示成功， 其余表示不成功
     * @return object sv_list 视频列表{"page_count":20, {{"id":"视频ID","uid":"发布视频用户ID","url":"视频地址","gif":"gif地址","title":"标题","praise":点赞数,"is_follow":是否点赞,"price":"价格","user":{"nickname":"昵称","avatar":"用户头像"},"state":审核状态,"power_code":权限码}}}
     * @return string msg 提示信息
     * @
     */
    public function home()
    {

        echo json_encode(array('status' => 0, 'msg' => '请先登录后再访问'));
    }


    public function testing($method = '')
    {
//        // 判断非生成环境才能访问
//        if (is_production_env()) {
//            exit();
//        }

        if ($method) {
            switch ($method) {
                case 'home':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'type' => 'new',
                        'page_index' => 1,
                        'page_size' => 10,
                        'page_count' => 3,
                    );
                    break;

                case 'home':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'type' => 'new',
                        'page_index' => 1,
                        'page_size' => 10,
                        'page_count' => 3,
                    );
                    break;

                case 'message':
                    $_POST = array(
                        'token' => 'NDYzOTEtMTYtMTUxMTQwNDA0Nixhc2QhQCNmZ2gkJV5qa2wmKig',
                        'type' => 'system',
                        'page_index' => 1,
                        'page_size' => 100,
                    );
                    break;

                case 'message_read':
                    $_POST = array(
                        'token' => '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
                        'message_id' => 'all',
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
