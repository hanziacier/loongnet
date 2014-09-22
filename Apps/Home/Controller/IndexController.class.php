<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $user = new \Common\Model\UserModel("User");
        var_dump($user->getUser());
        $login = new \Common\Logic\LoginLogic("Login");
        var_dump($login->login());
        $this->display();
    }
}