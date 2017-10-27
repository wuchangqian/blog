<?php

namespace Admin\Model;

use Think\Model;

class PostModel extends Model
{
    protected $tableName = 'posts';

    protected $_validate = array(
        array('title', 'require', '请填写标题！', 1),
        array('content', 'require', '请填写内容！', 1),
    );

    protected $_auto = array(
        array('uid', 'getUid', 3, 'callback'),
        array('createtime', 'time', 1, 'function'),
        array('updatetime', 'time', 3, 'function'),
    );

    /**
     * 获取uid
     */
    protected function getUid()
    {
        $online = session('online');
        if ($online) {
            $uid = unserialize($online)['id'];
        } else {
            $uid = '';
        }
        return $uid;
    }

}
