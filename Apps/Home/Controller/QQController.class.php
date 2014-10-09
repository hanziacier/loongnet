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
        import("Oauth");
        $QC = new \Oauth();
        $QC->qq_login();
    }

    public function loginBack()
    {

        $_GET['code'] = I('get.code');
        $_GET['state'] = I('get.state');
        import("QC");
        import("Oauth");
        $Oauth = new \Oauth();
        echo "qq_callback:accessToken ";
        $accessToken = $Oauth->qq_callback();
        var_dump($accessToken);
        echo "get_openid:openId ";
        $openId = $Oauth->get_openid();
        var_dump($openId);
        echo "get_user_info:";
        $QC = new \QC($accessToken, $openId);
        $ret = $QC->get_user_info();
        var_dump($ret);


    }
} 