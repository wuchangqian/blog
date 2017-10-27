<?php


namespace Admin\Controller;
use Think\Page;
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 15:39
 */

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
        $config = D('Config');
        if(IS_POST){
            $data = $_POST;
            if(!$data){
                $this->assign('res' , json_encode(['msg' => $config->getError() , 'code' => '-1']));
            }else{
                foreach($data as $k => $v) {
                    $where['name'] = $k;
                    if($config->where($where)->find()){
                        $config->where($where)->setField('value' , $v);
                    }else{
                        $tmp = ['name' => $k , 'value' => $v];
                        $config->add($tmp);
                    }
                }
                $this->assign('res' , json_encode(['msg' => '保存成功' , 'code' => '0']));
            }
        }
        $conf = $config->select();
        $configs = [];
        foreach($conf as $v) {
            $configs[$v['name']] = $v['value'];
        }
        $this->assign('configs',$configs);

        $this->display('system:config:config');
    }

    /**
     * @Name:dict
     * @Description:数据字典
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function dict()
    {
        $dicts = D('Dicts');

        $where = ['fid' => 0];

        $dict = $dicts->where($where)->order('id asc , updateAt desc')->select();

        $where = [];
        if(I('get.keyword')){
            $where['name'] = ['like','%'.I('get.keyword').'%'];
            $this->assign('keyword' , I('get.keyword'));
        }
        foreach($dict as $k => $v) {
            $where['cateId'] = $v['id'];
            $where['name'] = ['like','%'.I('get.keyword').'%'];
            $dict[$k]['sub'] = $dicts->where($where)->order('id asc , updateAt desc')->select();
        }
        foreach($dict as $k => $v) {
            if(!$v['sub']){
                unset($dict[$k]);
            }
        }

        $this->assign('data' , [
            'list' => $dict
        ]);

        $this->display('system:dicts:dict');
    }

    /**
     * @Name:dict_add
     * @Description:添加字典
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function dict_add()
    {
        $dicts = D('Dicts');
        if(IS_AJAX){
            if($dicts->where($_POST)->find()){
                $this->ajaxReturn([
                    'code' => -3,
                    'msg' => '已存在相同的数据'
                ]);
            }
            if(!$dicts->create()){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => $dicts->getError()
                ]);
            }

            if($dicts->add()){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '添加成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '写入失败'
                ]);
            }
        }else{
            $where = ['cateId' => 0];
            $this->assign('cates' , $dicts->where($where)->select());
            $this->display('system:dicts:dict_add');
        }
    }

    /**
     * @Name:dict_edit
     * @Description:编辑字典
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function dict_edit()
    {
        $dicts = D('Dicts');
        if(IS_AJAX){
            if(!$dicts->create()){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => $dicts->getError()
                ]);
            }

            if($dicts->save()){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '编辑成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '写入失败'
                ]);
            }
        }else{
            $id = I('get.did');
            $where = ['id' => $id];
            $dict = $dicts->where($where)->find();
            if(!$dict){
                $this->show($this->buildMsg());
                exit();
            }
            $this->assign('dict' , $dict);

            $where = ['cateId' => 0];
            $this->assign('cates' , $dicts->where($where)->select());

            $this->display('system:dicts:dict_edit');
        }

    }

    /**
     * @Name:dict_del
     * @Description:删除字典
     * @HideInMenu:1
     * @Author:wangyu
     */
    public function dict_del()
    {
        $dicts = D('Dicts');
        $id = I('post.id');
        if(is_array($id)){
            $where = ['id' => ['in' , $id]];
            if($dicts->where($where)->delete()){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '删除成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '删除失败'
                ]);
            }
        }else{
            $where = ['id' => $id];
            $dict = $dicts->where($where)->find();
            if(!$dict){
                $this->ajaxReturn([
                    'code' => -1,
                    'msg' => '数据不存在'
                ]);
            }
            if($dict['cateId'] == 0){
                $where = ['cateId' => $id];
                if($dicts->where($where)->find()){
                    $this->ajaxReturn([
                        'code' => -3,
                        'msg' => '该记录下还有子记录'
                    ]);
                }
            }
            if($dicts->delete($id)){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '删除成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '删除失败'
                ]);
            }
        }
    }

    /**
     * @Name:refresh
     * @Description:更新缓存
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function refresh()
    {
        $cacheDir = ROOT_PATH.'/Runtime';
        $this->unlink($cacheDir);
        $cacheFile = session('cache');
        if($cacheFile){
            foreach($cacheFile as $v) {
                echo '<div style="text-align: center">删除临时文件 <del style="color: red">'.basename($v).'</del></div>';
            }
            echo '<div style="text-align: center ; color: #00B83F">缓存更新完成</div>';
            session('cache',null);
        }
    }

    /**
     * @Name:shield
     * @Description:屏蔽词
     * @HideInMenu:0
     * @Author:wangyu
     */
    public function shield()
    {
        $badWords = D('BadWords');
        if(IS_POST){
            $val = I('post.badWords');

            $total = $badWords->count();
            if($total > 4){
                $want = $badWords->field('ver')->order('ver desc')->limit(4)->select();
                $wantIds = array_column($want , 'ver');
                $where = ['ver' => ['notin' , $wantIds]];
                $badWords->where($where)->delete();
            }

            if($badWords->add(['value' => $val])){
                $this->ajaxReturn([
                    'code' => 0,
                    'msg' => '保存成功'
                ]);
            }else{
                $this->ajaxReturn([
                    'code' => -2,
                    'msg' => '更新失败'
                ]);
            }
        }
        $val = $badWords->order('ver desc')->getFIeld('value');
        $this->assign('badWords' , $val);
        $this->display('system:shield:shield');
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
        $this->display('system:power:power');
    }

}