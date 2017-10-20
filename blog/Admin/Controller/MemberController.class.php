<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 15:58
 */
namespace Admin\Controller;

/**
 * @Description:会员管理
 * @Icon:&#xe60d;
 * @Name: MemberController
 * @Author: wangyu
 * @HideInMenu:0
 */
class MemberController extends CommonController
{
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

    /**
     * @Name:remove
     * @Description:删除的用户
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function remove()
    {
        $this->display();
    }
}