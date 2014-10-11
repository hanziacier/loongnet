<?php
namespace Home\Controller;

use Think\Controller;
use \Common\Logic\LoginLogic as LL;

class BaseController extends Controller
{
    const COOKIEUSERKEY = 'u_s_e_r_d_a_t_a';

    protected function setLogin($accessToken)
    {
        cookie(self::COOKIEUSERKEY, $accessToken);
    }

    protected function getUser()
    {
        if ($accessToken = cookie(self::COOKIEUSERKEY)) {
            $user = LL::parseAccessToken($accessToken);
            return $user;
        }
        return false;

    }
}