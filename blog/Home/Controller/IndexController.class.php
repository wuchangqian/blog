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
        foreach($articles as $k => $v) {
            $articles[$k]['tags'] = explode('|' , $v['tags']);
        }
        $this->assign('posts' , $articles);
        $cate = [];
        foreach($cates as $v) {
            $cate[$v['id']] = $v;
        }
        $tag = [];
        foreach($tags as $v) {
            $tag[$v['id']] = $v;
        }
        $this->assign('cate' , $cate);
        $this->assign('tags' , $tag);
        $this->display();
    }
}