<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/31
 * Time: 11:07
 */

namespace Home\Controller;


class PostController extends CommonController
{

    public function _initialize()
    {
        parent::_initialize();
    }

    public function view()
    {
        $url = I('get.url');
        $posts = D('Posts');
        $where = ['url' => $url , 'status' => 1];
        $article = $posts->where($where)->find();
        if(!$article){
            $this->_404();
            exit();
        }
        $article['tags'] = explode('|' , $article['tags']);
        $this->assign('post',$article);
        $dicts = D('Dicts');
        $cates = $dicts->where(['cateId' => 4])->select();
        $cate = [];
        foreach($cates as $v) {
            $cate[$v['id']] = $v;
        }
        $tags = $dicts->where(['cateId' => 7])->select();
        $tag = [];
        foreach($tags as $v) {
            $tag[$v['id']] = $v;
        }
        $this->assign('cate' , $cate);
        $this->assign('tags' , $tag);
        $users = D('Users');
        $filed = 'id , username';
        $where = ['role' => 1];
        $authors = $users->field($filed)->where($where)->select();
        $author = array_column($authors , 'username' , 'id');
        $this->assign('author' , $author);
        $this->display();
    }

    public function category()
    {
        $url = I('get.url');
        $dicts = D('Dicts');
        $where = ['cateId' => 4 , 'url' => $url];
        $id = $dicts->where($where)->getField('id');
        if(!$id){
            $this->_404('Common:404');
            exit();
        }
        $posts = D('Posts');
        $cates = $dicts->where(['cateId' => 4])->select();
        $tags = $dicts->where(['cateId' => 7])->select();
        $where = ['status' => 1 , 'cate' => $id];
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

        $this->display('Index:index');
    }

    public function tag()
    {
        $url = I('get.url');
        $dicts = D('Dicts');
        $where = ['cateId' => 7 , 'url' => $url];
        $id = $dicts->where($where)->getField('id');
        if(!$id){
            $this->_404('Common:404');
            exit();
        }
        $posts = D('Posts');
        $cates = $dicts->where(['cateId' => 4])->select();
        $tags = $dicts->where(['cateId' => 7])->select();
        $where = [];
        $where['status'] = 1;
        $where['tags'] = ['like' , '%|'.$id.'|%'];
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
        $this->display('Index:index');
    }
}