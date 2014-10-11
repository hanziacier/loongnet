<?php
/**
 * Created by ihanke
 * User: hanzi99@126.com
 * Date: 14-9-28
 * Time: 上午9:55
 */

namespace Home\Controller;

use Think\Controller;

class UserController extends BaseController
{

    function __construct()
    {
        parent::__construct();

    }

    public function register()
    {
        $data = array_merge(I("post."));

        if ($id = LL::register($data)) {
            echo $id;
        } else {
            echo LL::getLogicError();
        }
    }

    public function index()
    {
        $user = $this->getUser();
        echo $user['name'];
    }
} 