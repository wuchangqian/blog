<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/16
 * Time: 17:33
 */


/**
 * 生成随机字符串
 * @param int $len 长度
 * @param int $type 类型 0混合 1数字
 * @return string
 */
function randStr($len = 8 , $type = 0)
{
    PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
    $seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $type ? 10 : 35);
    $seed = $type ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for($i = 0; $i < $len; $i++) {
        $hash .= $seed[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 明文密码和密钥生成密文
 * @param string $pwd
 * @param string $salt
 * @return string
 */
function generatePassword($pwd , $salt)
{
    $str = $pwd.$salt;
    return md5($str);
}

/**
 * 校验用户输入的密码
 * @param string $pwd 用户输入密码
 * @param string $dbPwd 数据库存储密码
 * @param string $salt 密钥
 * @return bool
 */
function checkPassword($pwd , $dbPwd , $salt)
{
    $pwd = generatePassword($pwd , $salt);
    return $pwd === $dbPwd ? true : false;
}

/**
 * 校验验证码
 * @param string $code 用户输入的验证码
 * @param int $id 验证码编号（当一个页面用到多个验证码，需要给定编号）
 * @return bool
 */
function checkVerifyCode($code , $id = '')
{
    $verify = new \Think\Verify();
    return $verify->check($code , $id);
}

/**
 * 可逆字符串加解密
 * @param string $string 字符串
 * @param string $operation DECODE解密 其他加密
 * @param string $key 密钥
 * @param int $expiry 有效期
 * @return bool|string
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key ? $key : "da7b4db15be94a4c597a34f9cf902b01");
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }

}

/**
 * 获取当前在线用户id
 * @return mixed
 */
function get_uid()
{
    $user = unserialize(session('online'));
    return $user['id'];
}

/**
 * 用户设置在线并更新对应记录
 * @param array $user
 */
function setOnline(array $user)
{
    if(isset($user['salt'])){
        unset($user['salt']);
    }
    if(isset($user['password'])){
        unset($user['password']);
    }

    $count = $user['loginNum'] + 1;

    $users = D('Users');
    $where = ['id' => $user['id']];
    $update = ['lastLogin' => time() , 'lastIp' => $_SERVER['REMOTE_ADDR'] , 'loginNum' => $count];
    $users->where($where)->save($update);

    $user['express'] = time() + C('SESSION_EXP');
    $user['loginNum'] = $count;
    session('online' , serialize($user));
}

/**
 * 登出
 */
function logout(){
    session(null);
}


