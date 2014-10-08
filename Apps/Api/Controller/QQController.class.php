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

class QQController extends BaseController
{

    function __construct()
    {
        parent::__construct();
        $this->enable_verify = 0;
    }

    public function loginBack()
    {
        echo '<meta property="qc:admins" content="3474706167675477676654" />';
    }


} 