<?php

namespace Admin\Controller;
use Think\Page;
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 15:53
 */

/**
 * @Description:权限管理
 * @Icon:&#xe62d;
 * @Name: AdminController
 * @Author: wangyu
 * @HideInMenu:0
 */
class AdminController extends CommonController
{
    /**
     * @Name:roles
     * @Description:角色管理
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function roles()
    {
        $this->display('admin:roles:roles');
    }

    /**
     * @Name:powers
     * @Description:权限列表
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function powers()
    {
        $powers = D('powers');
        $where = ['fid' => 0];

        $power = $powers->where($where)->order('sort asc , updateTime desc')->select();

        $where = [];
        if(I('get.keyword')){
            $where['name'] = ['like','%'.I('get.keyword').'%'];
            $this->assign('keyword' , I('get.keyword'));
        }
        foreach($power as $k => $v) {
            $where['fid'] = $v['id'];
            $where['name'] = ['like','%'.I('get.keyword').'%'];
            $power[$k]['sub'] = $powers->where($where)->order('sort asc , updateTime desc')->select();
        }
        foreach($power as $k => $v) {
            if(!$v['sub']){
                unset($power[$k]);
            }
        }

        $this->assign('powers' , [
            'list' => $power
        ]);
        $this->display('admin:powers:powers');
    }

    /**
     * @Name:powers_edit
     * @Description:编辑权限
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function powers_edit()
    {
        $powers = D('powers');
        if(IS_AJAX){
            if(!$powers->create()){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => $powers->getError()
                ]);
            }

            if($powers->save()){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '编辑成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '写入失败'
                ]);
            }


        }else{
            $id = I('get.pid');
            $where = ['id' => $id];
            $power = $powers->where($where)->find();
            if(!$power){
                $this->show($this->buildMsg());
                exit();
            }
            $this->assign('power' , $power);
            $this->display('admin:powers:powers_edit');
        }
    }

    /**
     * @Name:users
     * @Description:用户管理
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function users()
    {
        $this->display();
    }
}