<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 15:39
 */

namespace Admin\Controller;


/**
 * @Description:系统管理
 * @Icon:&#xe62e;
 * @Name: SystemController
 * @Author: wangyu
 * @HideInMenu:0
 */
class SystemController extends CommonController
{
    /**
     * @Name:config
     * @Description:系统配置
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function config()
    {
        $this->display();
    }

    /**
     * @Name:dict
     * @Description:数据字典
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function dict()
    {
        $this->display();
    }

    /**
     * @Name:categories
     * @Description:栏目管理
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function categories()
    {
        $this->display();
    }

    /**
     * @Name:shield
     * @Description:屏蔽词
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function shield()
    {
        $this->display();
    }

    /**
     * @Name:log
     * @Description:系统日志
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function log()
    {
        $this->display();
    }

    /**
     * @Name:power
     * @Description:更新权限
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function power()
    {
        $this->syncPower();
        $this->display();
    }

}