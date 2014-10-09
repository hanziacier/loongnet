<?php
/**
 * Created by ihanke
 * User: hanzi99@126.com
 * Date: 14-9-28
 * Time: 上午9:55
 */

namespace Home\Controller;

use Think\Controller;
use \Common\Logic\LoginLogic as LL;

class QQController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->enable_verify = 0;
    }

    public function login()
    {
        import("QC");
        $QC = new \QC();
        $QC->qq_login();
    }

    public function loginBack()
    {

        $_GET['code'] = I('get.code');
        $_GET['state'] = I('get.state');
        import("QC");
        $QC = new \QC();
        echo "qq_callback:accessToken ";
        $accessToken = $QC->qq_callback();
        var_dump($accessToken);
        echo "get_openid:openId ";
        $openId = $QC->get_openid()
        echo "get_user_info:";
        $ret = $QC->get_user_info();
        var_dump($ret, $QC->);


    }
} 