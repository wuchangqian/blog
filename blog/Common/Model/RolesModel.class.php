<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/19
 * Time: 11:05
 */

namespace Common\Model;


use Think\Model;

class RolesModel extends Model
{
    protected $_validate = [
        ['name','require','请输入角色名',0],
        ['name','','角色名已存在！',0,'unique']
    ];

    protected $_auto = [
        ['status','1'],
        ['updateAt','time',1,'function'],
        ['createAt','time',2,'function']
    ];
}