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

class QQController extends BaseController
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
        $QC = new \QC();

        if (($accessToken = $QC->qq_callback()) && ($openId = $QC->get_openid())) {
            $QC->setAccessToken($accessToken);
            $QC->setOpenId($openId);
            $ret = $QC->get_user_info();
            if ($ret['ret'] == 0) { //成功登录
                if (LL::thirdUserSave($openId, $ret['nickname'], UM::TYPE_QQ)) {
                    $selfAccessToken = LL::login($ret['nickname'] . $openId, $ret['nickname'] . UM::TYPE_QQ);
                    if ($selfAccessToken) {
                        $this->setLogin($selfAccessToken);
                        $this->redirect('/Home/Index/index', array('from' => 'qq'));
                    } else {
                        $this->error('登录失败', '/index.php/Home/Index/index');
                    }
                } else {
                    $this->error('保存QQ登陆信息失败', '/index.php/Home/Index/index');
                }
            } else {
                $this->error('获取用户信息失败', '/index.php/Home/Index/index');
            }
        } else {
            $this->error('授权失败', '/index.php/Home/Index/index');
        }

    }
} 