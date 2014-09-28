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

class UserController extends Controller
{

    function __construct()
    {
        parent::__construct();

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