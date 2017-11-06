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
        $posts = D('Posts');
        $count = $posts->field('cate , count(*) as num')->group('cate')->select();
        $res = array_column($count , 'num' , 'cate');
        foreach($cates as $k => $v) {
            if(isset($res[$v['id']]) && $res[$v['id']] > 0){
                $cates[$k]['num'] = $res[$v['id']];
            }else{
                unset($cates[$k]);
            }
        }
        $this->assign('GCate' , $cates);
    }

    public function _404()
    {
        $this->display('common:404');
    }
}