<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function _initialize()
    {
        $configs = D('config');
        $config = $configs->select();
        $conf = array_column($config , 'value','name');
        $this->assign('conf' , $conf);

        $dicts = D('Dicts');
        $cates = $dicts->where(['cateId' => 4])->select();
        $this->assign('GCate' , $cates);
    }

    public function _404()
    {
        $this->display('common:404');
    }
}