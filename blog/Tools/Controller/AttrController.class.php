<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/11/6
 * Time: 11:04
 */

namespace Tools\Controller;


use Think\Controller;

class AttrController extends Controller
{
    public function up()
    {
        if(!IS_AJAX){
            $this->ajaxReturn(array('code' => -1, 'msg' => '非法请求'));
        }
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     2*1024*1024 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Data/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $info   =   $upload->upload();
        if(!$info) {
            $this->ajaxReturn(array('code' => -2, 'msg' => $this->error($upload->getError())));
        }else{
            $path = substr($upload->rootPath , 1) .  $upload->savePath . $info['img']['savepath'] . $info['img']['savename'];
            $tmp = [
                'name' => $info['img']['name'],
                'type' => 0,
                'path' => $path,
                'opUser' => get_uid(),
                'createTime' => time()
            ];
            if(D('Attrs')->add($tmp)){
                $this->ajaxReturn(['code' => 0, 'msg' => '上传成功' , 'data' => ['path' => $path]]);
            }else{
                $this->ajaxReturn(['code' => -3, 'msg' => '写入失败' ]);
            }
        }
    }
}