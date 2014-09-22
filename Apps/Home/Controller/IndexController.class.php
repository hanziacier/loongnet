<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $user = new \Common\Model\UserModel();
        var_dump($user->getUser());
        $login = new \Common\Logic\LoginLogic();
        var_dump($login->login());
        $this->display();
    }
}