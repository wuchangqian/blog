<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 16:02
 */

namespace Admin\Controller;

/**
 * @Description:评论管理
 * @Icon:&#xe622;
 * @Name: CommentController
 * @Author: wangyu
 * @HideInMenu:0
 */
class CommentController extends CommonController
{
    /**
     * @Name:lists
     * @Description:评论列表
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function lists()
    {
        $this->display();
    }

    /**
     * @Name:remove
     * @Description:删除的评论
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function remove()
    {
        $this->display();
    }
}