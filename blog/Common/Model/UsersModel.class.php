<?php
namespace Common\Model;

use Think\Model;
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/16
 * Time: 17:46
 */
class UsersModel extends Model
{
    protected $_validate = [
        ['username','require','帐号名称已经存在！',0,'unique',3],
        ['password','require','请输入密码'],
    ];

}