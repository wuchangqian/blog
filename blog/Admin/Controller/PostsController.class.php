<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 16:02
 */

namespace Admin\Controller;

/**
 * @Description:文章管理
 * @Icon:&#xe622;
 * @Name: PostsController
 * @Author: wangyu
 * @HideInMenu:0
 */
class PostsController extends CommonController
{

    /**
     * @Name:add
     * @Description:发布文章
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function add()
    {
        $db = D('Post');
        if (IS_POST) {
            if (!$db->create()) {
                $this->error($db->getError());
                exit();
            } else {
                if (!$db->add()) {
                    $this->error('添加失败');
                } else {
                    $this->success('添加成功', U('admin/posts/lists'));
                }
            }
        } else {
            $this->display();
        }
    }

    /**
     * @Name:lists
     * @Description:文章列表
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function lists()
    {
        $db = D('Post');
        $userDb = D('User');
        $where = array();
        $where['status'] = array('in', array('0', '1'));
        $count = $db->where($where)->count();
        $page = new \Think\Page($count , C('PAGE_LIMIT'));
        $show = $page->show();
        $list = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('updatetime desc,id desc')->select();

        $userList = $userDb->field('id,username')->where(array('status' => 1))->select();
        foreach ($userList as $key => $value) {
            $userList[$value['id']] = $value;
        }

        foreach ($list as $k => $v) {
            $list[$k]['username'] = $userList[$v['uid']]['username'];
        }

        $this->assign('total', $count);
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * @Name:edit
     * @Description:编辑文章
     * @HideInMenu:1
     * @Author:yc
     */
    public function edit()
    {
        $db = D('Post');
        if (IS_AJAX) {
            if (!$db->create()) {
                $this->ajaxReturn(array('code' => -10, 'msg' => $db->getError()));
            } else {
                if (!$db->save()) {
                    $this->ajaxReturn(array('code' => -20, 'msg' => '数据更新失败！'));
                } else {
                    $this->ajaxReturn(array('code' => 0, 'msg' => '更新成功！'));
                }
            }
        } else {
            $id = I('get.id');
            $info = $db->field('id,title,content,status')->where(array('id' => $id))->find();
            if (!$info) {
                $this->error('该数据不存在！');
                exit();
            }
            $this->assign('info', $info);
            $this->display();
        }
    }

    /**
     * @Name:status
     * @Description:修改状态
     * @HideInMenu:1
     * @Author:yc
     */
    public function status()
    {
        $db = D('Post');
        if (IS_AJAX) {
            $id = I('post.id');
            $info = $db->where(array('id' => $id))->find();
            if (!$info) {
                $this->ajaxReturn(array('code' => -10, 'msg' => '数据不存在！'));
            }
            $data = $info['status'] == 1 ? 0 : 1;
            $msg = $info['status'] == 1 ? '停用' : '启用';
            if ($db->where(array('id' => $info['id']))->setField('status', $data)) {
                $this->ajaxReturn(array('code' => 0, 'msg' => $msg . '成功'));
            } else {
                $this->ajaxReturn(array('code' => -20, 'msg' => $msg . '失败'));
            }
        } else {
            $this->error('请求出错！');
        }
    }

    /**
     * @Name:del
     * @Description:删除文章
     * @HideInMenu:1
     * @Author:yc
     */
    public function del()
    {
        $db = D('Post');
        if (IS_AJAX) {
            $id = I('post.id');
            $info = $db->where(array('id' => $id))->find();
            if (!$info) {
                $this->ajaxReturn(array('code' => -10, 'msg'=>'数据不存在！'));
            }
            if (!$db->where(array('id' => $id))->delete()) {
                $this->ajaxReturn(array('code' => -20, 'msg'=>'删除失败！'));
            } else {
                $this->ajaxReturn(array('code' => 0, 'msg'=>'删除成功！'));
            }
        } else {
            $this->error('请求出错！');
        }
    }

    /**
     * @Name:batchdelete
     * @Description:批量删除
     * @HideInMenu:1
     * @Author:yc
     */
    public function batchdelete()
    {
        $db = D('Post');
        if (IS_AJAX) {
            $ids = I('post.ids');
            $ids = substr($ids,0,-1);
            $where = array();
            $where['id'] = array('in',$ids);
            $list = $db->field('id')->where($where)->select();
            if (!$list) {
                $this->ajaxReturn(array('code' => -10, 'msg'=>'数据不存在！'));
            }
            if (!$db->where($where)->delete()) {
                $this->ajaxReturn(array('code' => -20, 'msg'=>'删除失败！'));
            } else {
                $this->ajaxReturn(array('code' => 0, 'msg'=>'删除成功！'));
            }
        } else {
            $this->error('请求出错！');
        }
    }
}