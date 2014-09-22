<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        $user = D("User");
        var_dump($user);
        var_dump(D("Login","Logic")->login());
        $this->display();
    }
}