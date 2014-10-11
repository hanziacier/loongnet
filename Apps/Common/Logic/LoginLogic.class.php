<?php
/**
 * Created by PhpStorm.
 * User: leju
 * Date: 14-9-19
 * Time: 上午10:48
 */

namespace Common\Logic;

use Think\Model;
use \Common\Model\UserModel as UM;

class LoginLogic extends Model {
    const SECURITYKEY = "IHanke!@QW";
    const SECURITYSTEP = "~1@3$5~";
    const EXPIRE = 1800;
    protected static $logicError;
    public static function login($user_name,$password){
        $model = new UM();
        $user = $model->getUserByName($user_name);
        $access_token = false;
        if($user['id']){
            if(md5($password) != $user['password']){
                self::$logicError = "密码错误";
            }else{
                $access_token = self::createAccessToken($user);
            }
        }else{
            self::$logicError = "不存在此用户";
        }

        return $access_token;
    }

    public static function register($data)
    {
        if (empty($data['name']) ||
            empty($data['password'])
        ) {
            self::$logicError = "注册数据不完整";
            return false;
        }
        $model = new UM();
        $user = $model->getUserByName($data['name']);
        if ($user && $user['id']) {
            self::$logicError = "用户名已经被占用";
            return false;
        }
        $data['password'] = md5($data['password']);
        if ($model->create($data)) {
            return $model->add();
        } else {
            self::$logicError = $model->getError();
            return false;
        }

    }

    public static function thirdUserSave($pid, $name, $type)
    {
        if (in_array($type, UM::getThirdType())) {
            $model = new UM();
            $where['pid'] = $pid;
            $type['type'] = $type;
            $user = $model->where($where)->find();
            if ($user['id']) {
                $data = array(
                    'id' => $user['id'],
                    'name' => $name . $pid,
                    'password' => md5($name . $type)
                );
                $model->where('id=' . $user['id'])->save($data);
                return true;
            } else {
                $data = array(
                    'pid' => $pid,
                    'type' => $type,
                    'name' => $name . $pid,
                    'password' => md5($name . $type),
                    'status' => UM::STATUS_COMMON

                );
                if ($model->create($data)) {
                    return $model->add();
                }
            }
        }
        return false;
    }

    public static function getLogicError(){
        return self::$logicError;
    }
    public static function isLogin($access_token){
        $user = self::parseAccessToken($access_token);
        if($user['id'] && $user['name'] && time() < $user['expire']) return $user;
        return false;
    }

    public static function createAccessToken(array $user)
    {
        $expire = time() + self::EXPIRE;
        return self::crypt($user['id'] .self::SECURITYSTEP.
            $user['name'] .self::SECURITYSTEP.
            $user['mobile'] .self::SECURITYSTEP.
            $user['pid'] . self::SECURITYSTEP .
            $user['type'] . self::SECURITYSTEP .
            $user['add_time'] . self::SECURITYSTEP .
            $user['status'] . self::SECURITYSTEP .
            $expire,
            $securityKey);
    }

    public static function parseAccessToken(string $access_token)
    {
        $access_token = self::crypt($access_token, $securityKey, 'decode');
        $user = array();
        list($user['id'],
            $user['name'],
            $user['mobile'],
            $user['pid'],
            $user['type'],
            $user['add_time'],
            $user['status'],
            $user['expire']) = explode(self::SECURITYSTEP, $access_token);
        return $user;
    }
    /**
     * 加密，解密方法。
     *
     * @param string $string
     * @param string $key
     * @param string $operation encode|decode
     * @return string
     */
    public static function crypt($string, $key, $operation = 'encode') {
        $key_length = strlen($key);
        $string = (strtolower($operation) == 'decode') ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';

        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if (strtolower($operation) == 'decode') {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
                return substr($result, 8);
            } else {
                return '';
            }
        } else {
            return base64_encode($result);
        }
    }
} 