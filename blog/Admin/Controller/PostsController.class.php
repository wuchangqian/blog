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
        $this->display();
    }

    /**
     * @Name:lists
     * @Description:文章列表
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function lists()
    {
        $this->display();
    }
}