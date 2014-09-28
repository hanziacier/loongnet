<?php
/**
 * Created by ihanke
 * User: hanzi99@126.com
 * Date: 14-9-28
 * Time: 上午9:55
 */

namespace Api\Controller;

use Think\Controller;
use \Common\Logic\LoginLogic as LL;

class UserController extends BaseControllerController
{

    function __construct()
    {
        parent::__construct();

    }

    public function login()
    {
        $data = array_merge(I("get."), I("post."));
        $result = LL::login($data['name'], $data['password']);
        if ($result) {
            $this->jsonReturn(1, LL::parseAccessToken($result), "登录成功");
        } else {
            $this->jsonReturn(0, '', LL::getLogicError());
        }
    }

    public function register()
    {
        $data = array_merge(I("get."), I("post."));

        if ($id = LL::register($data)) {
            echo $id;
        } else {
            echo LL::getLogicError();
        }
    }
} 