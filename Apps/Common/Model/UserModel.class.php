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

    const STATUS_INIT = 0;//未审核
    const STATUS_COMMON = 2;//审核通过
    const STATUS_DELETE = -4;//删除
    const STATUS_REJECT = -2;//审核驳回
    protected $tablePrefix = '';

    //array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
    //验证条件
    //	Model::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
    //	Model::MUST_VALIDATE 或者1 必须验证
    //	Model::VALUE_VALIDATE或者2 值不为空的时候验证

    //验证时间：
    //Model:: MODEL_INSERT 或者1新增数据时候验证

    //Model:: MODEL_UPDATE 或者2编辑数据时候验证

    //Model:: MODEL_BOTH 或者3 全部情况下验证（默认）
    protected $_validate = array(
        array('id','require','id错误', Model::MUST_VALIDATE,'', Model:: MODEL_UPDATE),
        array('name', 'require', '请填用户名', Model::MUST_VALIDATE), //默认情况下用正则进行验证
        array('name', '', '用户名已经存在', Model::MUST_VALIDATE, '', unique, Model::MODEL_BOTH), //默认情况下用正则进行验证
        array('password', 'require', '请填用户密码', Model::MUST_VALIDATE,"",Model::MODEL_INSERT), //默认情况下用正则进行验证
        array('mobile', 'number', '请填用户手机号', Model::VALUE_VALIDATE), //默认情况下用正则进行验证
        array('status', 'number', '', Model::VALUE_VALIDATE,self::STATUS_INIT,Model::MODEL_BOTH), //默认情况下用正则进行验证
        array('add_time', 'number', '', Model::VALUE_VALIDATE, '', Model::MODEL_BOTH), //默认情况下用正则进行验证

    );
    protected $_auto = array(
        array('status', self::STATUS_INIT), // 新增的时候把status字段设置为1
        array('add_time', 'time', Model::MODEL_INSERT, 'function'), // 对update_time字段在更新的时候写入当前时间戳
    );

    public  function getUser($id=0){
        return $this->find($id);
    }
    public function getUserByName($name){
        $where = array("name"=>$name);
        return $this->where($where)->find();
    }
    public function addUser($user){

    }
} 