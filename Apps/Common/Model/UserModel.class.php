<?php
/**
 * Created by PhpStorm.
 * User: leju
 * Date: 14-9-19
 * Time: 上午10:48
 */

namespace Common\Model;

use Think\Model;
class UserModel extends Model {
    protected $tablePrefix = '';
    public  function getUser(){
        $user = array("id"=>"1");
        return $user;
    }
    public function getUserByName($name){
        $where = array("name"=>$name);
        return $this->where($where)->find();
    }
} 