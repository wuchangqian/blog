<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/23
 * Time: 14:05
 */

namespace Common\Model;


use Think\Model;

class DictsModel extends Model
{
    protected $_validate = [
        ['name' , 'require' , '字典名称必填哦' , 1 , '' , 3]
    ];

    protected $_auto = [
        ['createAt' , 'time' , 1 , 'function'],
        ['updateAt' , 'time' , 2 , 'function']
    ];
}