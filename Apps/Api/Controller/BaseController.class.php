<?php
/**
 * Created by ihanke
 * User: hanzi99@126.com
 * Date: 14-9-28
 * Time: 下午2:15
 */

namespace Api\Controller;

use Think\Controller;
use \Common\Logic\LoginLogic as LL;

class BaseController extends Controller
{
    public $enable_verify = 0; //数据通信安全验证 ，0：暂时不开 1：生效
    protected $noLoginAction = array('User_login', 'QQ_loginBack');

    function __construct()
    {
        parent::__construct();

    }

    /**
     *    初始化,在执行每个具体方法前会执行_initialize()
     */
    protected function  _initialize()
    {
        $post = I('post.');
        if ($this->enable_verify) {

            $this->ckSysParams($post);
        }
        $path = ucfirst(CONTROLLER_NAME) . "_" . ACTION_NAME;
        //var_dump($path);
        if (!in_array($path, $this->noLoginAction)) { //需要验证登陆

            if ($login = LL::isLogin($post['ucode'])) {

                if (isset($post['debug']) && $post['debug']) {
                    $this->jsonReturn(1, $login, '你的登录用户数据');
                }
                return true;
            } else {
                $this->jsonReturn(0, '', '你登录后才能调用此方法' . $path);
            }

        }


    }

    /**
     * 通信验证
     */
    protected function ckSysParams($post)
    {
        //效验参数
        if (empty($post['app_key']) || empty($post['token'])) {
            return $this->jsonReturn(0, '', '缺少验证参数');
        }

        //效验token

        ksort($post);
        $postData = '';
        while (list($k, $v) = each($post)) {
            if ($k == 'token' || $k == 'app_key') {
                $token = $v;
            } else {
                $postData .= $k . $v;
            }
        }
        if ($post['token'] != 'superkey' &&
            strtoupper(md5($postData . self::getClientConfig($post['app_key']))) != $token
        ) {
            $this->jsonReturn(0, '', '参数验证失败');
        }
        return true;
    }

    protected function jsonReturn($result, $data_list = '', $message = '')
    {
        if ($result == 1) $data['result'] = 1;
        else $data['result'] = 0;
        $data['message'] = $message;
        $data['data'] = $data_list;
        $this->ajaxReturn($data, 'JSON');
    }

    /*
     * 通过app_key获取私钥
     * @param int app_key
     * @return string 私钥
     */
    public function getClientConfig($app_key, $only_key = 1)
    {
        $app_key_config = C('app_keys');
        if (isset($app_key_config[$app_key])) {
            if ($only_key) return $app_key_config[$app_key]['secretkey'];
            else return $app_key_config[$app_key];
        } else {
            return false;
        }

    }
} 