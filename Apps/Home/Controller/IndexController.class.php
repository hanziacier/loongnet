<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseController
{

    public function index()
    {
        //$user = new \Common\Model\UserModel("User");
        $user = D("User");
        //var_dump($user->getUser());
        // $login = new \Common\Logic\LoginLogic("Login");
        //$login = D("Login","Logic");
        //$login->login();
        //import("QC");
        //$QC = new \QC();
        //$ret = $QC->get_user_info();
        //var_dump($ret);
        $user = $this->getUser();
        echo $user['name'];
        $this->display();
    }
}