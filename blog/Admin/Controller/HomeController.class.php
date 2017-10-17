<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 13:42
 */

namespace Admin\Controller;


class HomeController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index()
    {
        $this->display();
    }

    public function welcome()
    {
        $ip = $this->user['lastIp'] != '::1' ? : '127.0.0.1';
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
        $json = file_get_contents($url);
        $info = json_decode($json , true)['data'];
        $this->assign('addr' , $info['country'].' '.$info['region'] .' '. $info['city'] .' '.$info['isp']);
        $mysql_ver = M('')->query("select version() as ver");
        $this->assign('mysql_ver' , $mysql_ver['0']['ver']);
        $this->display();
    }
}