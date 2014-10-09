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
        $ret = $QC->get_user_info();

        if ($ret['ret'] == 0) {
            echo "<meta charset='utf-8' />";
            require_once("get_info.html");
        } else {
            echo "<meta charset='utf-8' />";
            echo "获取失败，请开启调试查看原因";
        }
        echo "<hr />";
        if ($accessToken = $QC->qq_callback() && $openId = $QC->get_openid()) {
            $ret = $QC->get_info();

            if ($ret['ret'] == 0) {
                echo "<meta charset='utf-8' />";
                require_once("get_info.html");
            } else {
                echo "<meta charset='utf-8' />";
                echo "获取失败，请开启调试查看原因";
            }
        };
    }
} 