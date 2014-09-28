<?php
/**
 * Created by ihanke
 * User: hanzi99@126.com
 * Date: 14-9-28
 * Time: 上午9:55
 */

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{
    var $logic;

    function __construct()
    {
        parent::__construct();
        $this->logic = new \Common\Logic\LoginLogic();
    }

    public function register()
    {
        $data = array_merge(I("get."), I("post."));
    use \Common\Logic\LoginLogic as LL;

        if ($id = LL::register($data)) {
            echo $id;
        } else {
            echo LL::getLogicError();
        }
    }
} 