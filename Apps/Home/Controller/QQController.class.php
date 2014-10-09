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
use \Common\Model\UserModel as UM;

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
        import("QC");
        $Oauth = new \QC();
        echo "qq_callback:accessToken ";
        if ($accessToken = $Oauth->qq_callback() && $openId = $Oauth->get_openid()) {
            $Oauth->setAccessToken($accessToken);
            $Oauth->setOpenId($openId);
            $ret = $Oauth->get_user_info();
            if ($ret['ret'] == 0) { //成功登录
                LL::thirdUserSave($openId, $ret['nickname'], UM::TYPE_QQ);
                $selfAccessToken = LL::login($ret['nickname'], $ret['nickname']);
                var_dump('$selfAccessToken:',$selfAccessToken);
            }else{
                var_dump($ret);
            }
        }else{
            echo $accessToken. "___" . $openId;
        }

    }
} 