<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/16
 * Time: 17:31
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class IndexController extends Controller
{
    /**
     * 登录页
     */
    public function index()
    {
        if(IS_AJAX){
            $username = trim(I('post.username'));
            $password = trim(I('post.password'));
            if(substr($password , -8 ) === '[secret]'){
                $password = authcode(substr($password,0,-8) , 'DECODE' , C('SECRET_KEY'));
            }
            $verifyCode = trim(I('post.verifyCode'));
            if(!$username || !$password || !$verifyCode){
                $this->ajaxReturn(['code' => '-1' , 'msg' => '请正确输入登录信息']);
            }
            if(!checkVerifyCode($verifyCode)){
                $this->ajaxReturn(['code' => '-2' , 'msg' => '验证码错误哦！']);
            }
            $where = ['username' => $username , 'status' => 1 , 'role' => 1];
            $users = D('Users');
            $user = $users->field('id , username , password , salt , role , lastLogin , loginNum , lastIp')->where($where)->find();
            if(!$user){
                $this->ajaxReturn(['code' => '-3' , 'msg' => '账户或密码错误哦！']);
            }

            if(!checkPassword($password , $user['password'] , $user['salt'])){
                $this->ajaxReturn(['code' => '-3' , 'msg' => '账户或密码错误哦！']);
            }else{
                if(isset($_POST['online'])){
                    cookie('remember' , authcode($username.'||'.$password , 'ENCODE' , C('SECRET_KEY')));
                }
                setOnline($user);
                $this->ajaxReturn(['code' => '0' , 'msg' => '登录成功！' , 'data' => ['jump' => U('home/index')]]);
            }
        }else{
            if(isset($_COOKIE['remember'])){
                $str = authcode(cookie('remember') ,'DECODE' , C('SECRET_KEY'));
                list($user['username'] , $user['password']) = explode('||',$str);
                $user['online'] = 1;
                $LPWD = strlen($user['password']);
                $user['password'] = authcode($user['password'] , 'ENCODE' , C('SECRET_KEY'));
                $user['vp'] = substr($user['password'],0 ,$LPWD);
                $this->assign('user' , $user);
            }
            $this->display();
        }
    }

    private function generateAdmin()
    {
        $salt = randStr();
        $username = 'wangyu';
        $password = 'wangyu21';
        $user = [
            'username' => $username,
            'password' => generatePassword($password,$salt),
            'salt' => $salt,
            'role' => 1,
            'lastLogin' => '',
            'status' => 1,
            'updateAt' => '',
            'createAt' => time()
        ];

        $users = D('Users');

        $where = ['username' => $username];
        if($users->where($where)->find()){
            E('用户名重复');
        }

        $users->add($user);

        echo '添加成功';
    }


}