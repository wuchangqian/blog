<?php
namespace Home\Controller;


class IndexController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        $posts = D('Posts');
        $dicts = D('Dicts');
        $cates = $dicts->where(['cateId' => 4])->select();
        $tags = $dicts->where(['cateId' => 7])->select();
        $where = ['status' => 1];
        $articles = $posts->where($where)->order('createtime desc')->limit(10)->select();
        $cate = array_column($cates , 'name' , 'id' );
        $tag = array_column($tags , 'name' , 'id' );
        foreach($articles as $k => $v) {
            $articles[$k]['tags'] = explode('|' , $v['tags']);
        }
        $this->assign('posts' , $articles);
        $this->assign('cate' , $cate);
        $this->assign('tag' , $tag);
        $this->display();
    }
}