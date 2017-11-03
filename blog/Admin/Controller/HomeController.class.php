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
        $this->assign('info' , [
            'mysql_ver' => $mysql_ver['0']['ver'],
            'free_disk' => round((disk_free_space(".")/(1024*1024*1024)),2).'G',
            'uname' => php_uname(),
            'server_time' => date('Y-m-d H:i:s'),
            'php_ver' => PHP_VERSION,
            'out_time' => ini_get('max_execution_time'),
            'max_upload' => ini_get('upload_max_filesize'),
            'load_module' => implode(' | ',get_loaded_extensions()),

        ]);
        $this->display();
    }

    public function logout()
    {
        logout();
        $this->success('退出成功',U('index/index'));
    }
}