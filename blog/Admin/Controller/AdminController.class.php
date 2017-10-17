<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 15:53
 */

namespace Admin\Controller;

/**
 * @Description:管理员管理
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
        $this->display();
    }

    /**
     * @Name:powers
     * @Description:权限控制
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function powers()
    {
        $this->display();
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