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
        $roles = D('Roles');

        $where = [];
        $count = $roles->where($where)->count();
        $page = new Page($count , C('PAGE_LIMIT'));
        $show = $page->show();
        $fields = 'id,name,description,status';
        $list = $roles->field($fields)->where($where)->order('updateAt desc , createAt desc')->limit($page->firstRow , $page->listRows)->select();
        $this->assign('role' , [
            'total' => $count,
            'page' => $show,
            'list' => $list
        ]);
        $this->display('admin:roles:roles');

    }

    /**
     * @Name:roles_add
     * @Description:角色添加
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function roles_add()
    {
        $roles = D('Roles');
        if(IS_AJAX){
            if(!$roles->create()){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => $roles->getError()
                ]);
            }

            if($roles->add()){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '添加成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '写入失败'
                ]);
            }
        }else{
            $this->display('admin:roles:roles_add');
        }
    }

    /**
     * @Name:roles_edit
     * @Description:角色编辑
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function roles_edit()
    {
        $roles = D('Roles');
        if(IS_AJAX){
            if(!$roles->create()){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => $roles->getError()
                ]);
            }

            if($roles->save()){
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
            $id = I('get.rid');
            $where = ['id' => $id];
            $role = $roles->where($where)->find();
            if(!$role){
                $this->show($this->buildMsg());
                exit();
            }
            $this->assign('role' , $role);
            $this->display('admin:roles:roles_edit');
        }
    }

    /**
     * @Name:roles_del
     * @Description:角色删除
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function roles_del()
    {
        $roles = D('Roles');
        $id = I('post.id');
        if(is_array($id)){
            $where = ['id' => ['in' , $id]];
            if($roles->where($where)->delete()){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '删除成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '删除失败'
                ]);
            }
        }else{
            $where = ['id' => $id];
            $role = $roles->where($where)->find();
            if(!$role){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => '数据不存在'
                ]);
            }
            if($roles->delete($id)){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '删除成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '删除失败'
                ]);
            }
        }

    }

    /**
     * @Name:roles_powers
     * @Description:角色权限
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function roles_powers()
    {
        $roles = D('Roles');
        $powers = D('Powers');
        $rolePowers = D('rolePowers');
        if(IS_AJAX){
            $id = I('post.id');
            $where = ['roleId' => $id];
            $rolePowers->where($where)->delete();
            $power = I('post.powers');
            if(!empty($power)){
                $data = [];
                foreach($power as $v) {
                    $data[] = ['roleId' => $id , 'powerId' => $v];
                }
                $rolePowers->addAll($data);
            }
            $this->ajaxReturn([
                'code' => 0,
                'msg' => '设置成功'
            ]);
        }else{
            $id = I('get.rid');
            $where = ['id' => $id];
            $role = $roles->where($where)->find();
            if(!$role){
                $this->show($this->buildMsg('没有找到对应的角色'));
            }
            $this->assign('role' , $role);

            $where = ['roleId' => $id];
            $rolePower = $rolePowers->field('powerId')->where($where)->select();
            $hasPower = array_column($rolePower , 'powerId');
            $this->assign('hasPower' ,$hasPower);

            $where = ['fid' => 0];
            $power = $powers->where($where)->order('sort asc , updateTime desc')->select();
            foreach($power as $k => $v) {
                $where['fid'] = $v['id'];
                $power[$k]['sub'] = $powers->where($where)->order('sort asc , updateTime desc')->select();
            }
            $this->assign('powers', $power);
            $this->display('admin:roles:roles_powers');
        }
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
     * @Description:权限编辑
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
        $users = D('Users');
        $where = [];
        $count = $users->where($where)->count();
        $page = new Page($count , C('PAGE_LIMIT'));
        $show = $page->show();
        $user = $users->where($where)->order('lastLogin desc')->limit($page->firstRow , $page->listRows)->select();
        $this->assign('users' , [
            'total' => $count,
            'page' => $show,
            'list' => $user
        ]);
        $this->display('admin:users:users');
    }
}