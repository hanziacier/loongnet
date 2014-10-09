<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {

    public function index(){
        //$user = new \Common\Model\UserModel("User");
        $user = D("User");
        //var_dump($user->getUser());
        // $login = new \Common\Logic\LoginLogic("Login");
        //$login = D("Login","Logic");
        //$login->login();
        require_once(APP_PATH . "Common/Library/QQ/qqConnectAPI.php");
        //import("QC");

        $QC = new QC();
        $this->display();
    }
}