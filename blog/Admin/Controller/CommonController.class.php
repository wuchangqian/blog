<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/17
 * Time: 13:43
 */

namespace Admin\Controller;


use Think\Controller;

class CommonController extends Controller
{
    protected $user;
    private $powers;
    public function _initialize()
    {
        $this->user = unserialize(session('online'));
        $this->assign('user' , $this->user);
        if(!$this->user){
            $this->error('用户未登录' , U('index/index'));
            exit;
        }
        if($this->user['express'] < time()){
            $this->error('登录超时' , U('index/index'));
            exit;
        }
        $this->user['express'] = time() + C('SESSION_EXP');

        session('online' , serialize($this->user));

        $this->powers = D('Powers');
        if(!$this->powers->select()){
            $this->syncPower();
        }

        $this->buildMenu();

        $this->buildBread();
    }

    /**
     * 更新权限表
     */
    protected function syncPower()
    {
        $excludeFile = array(
            'CommonController.class.php',
            'IndexController.class.php',
            'HomeController.class.php',
            'index.html'
        );
        $files = array();
        $modelPath['Admin'] = ROOT_PATH.'/blog/Admin/Controller/';

        foreach($modelPath as $k => $v){
            $filesName[$k] = $this->readDir($v,$excludeFile,'file',false);
            foreach($filesName[$k] as $v){

                $files[$k]['namespace'] = $k.'\\'.'Controller' ;
                $files[$k]['Controller'][] = $v ;

            }
        }
        $anno = [];
        foreach($files as $k => $v){
            foreach($v['Controller'] as $b){
                $tmp = explode('.',$b);
                $class = $v['namespace'].'\\'.$tmp[0];
                $anno[$class] = $this->getClassAnnotations($class);
            }
        }

        foreach($anno as $k => $v){
            $controllerList[$k] = $v['controller']['Name'];
            $path = explode('\\',strtolower($k));
            $appName = $path[0];

            if($v['controller']['Description']){
                $top = array(
                    'name' => $v['controller']['Description'],
                    'icon' => $v['controller']['Icon'],
                    'fid' => 0,
                    'url' => str_replace('controller','',$path[2]),
                    'updateTime' => time()
                );
                $menu = $this->powers->where('url = "'.str_replace('controller','',$path[2]).'"')->find();
                if($menu){
                    $topId = $menu['id'];
                    $this->powers->where('id = '.$topId)->save($top);
                }else{
                    $topId = $this->powers->add($top);
                }
                if(!empty($v['action'])){
                    $url = array();
                    foreach($v['action'] as $a => $b){
                        $data = array();
                        if($b['Description']){
                            $data = array(
                                'name' => $b['Description'],
                                'fid' => $topId,
                                'url' => str_replace('controller','',$path[2]).'/'.$b['Name'],
                                'updateTime' => time(),
                                'HideInMenu' => $b['HideInMenu']
                            );
                            if($b['OutLink'] == 1){
                                $data['outLink'] = 1;
                                $data['outLinkUrl'] = $b['OutLinkUrl'];
                            }
                            if($b['groupName']){
                                $data['groupName'] = $b['groupName'];
                            }

                            $sub = $this->powers->where('url = "'.str_replace('controller','',$path[2]).'/'.$b['Name'].'"')->find();

                            if($sub){
                                unset($data['HideInMenu']);
                                $this->powers->where("id = ".$sub['id'])->save($data);
                            }else{
                                $this->powers->add($data);
                            }

                            $url[] = "'".str_replace('controller','',$path[2]).'/'.$b['Name']."'";
                        }
                    }
                    $this->powers->where("url not in (".implode(',',$url).") and fid = ".$topId."")->delete();
                }
            }

        }
    }

    /**
     * 读取目录夹下的文件/文件夹
     * @param string $dir 文件夹
     * @param array $exclude 排除文件列表
     * @param string $type 类型 all所有  dir文件夹  file文件
     * @param bool $fullPath 是否返回全路径
     * @return array
     */
    protected function readDir($dir,$exclude = array(),$type = 'all',$fullPath = true)
    {
        $files = [];
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if($file == '.' || $file == '..'){
                    continue;
                }
                if(in_array($file,$exclude)){
                    continue;
                }

                if($type == 'dir'){
                    if(filetype($dir.'/'.$file) != 'dir'){
                        continue;
                    }
                }elseif($type == 'file'){
                    if(filetype($dir.'/'.$file) != 'file'){
                        continue;
                    }
                }
                $files[] = $file;
            }
            closedir($dh);
        }
        if($fullPath && $files){
            foreach($files as $k => $v){
                $files[$k] = $dir.'/'.$v;
            }
        }
        return $files;
    }

    /**
     * @Name:getClassAnnotations
     * @Description:获取类的注释
     * @Author:wangyu
     */
    protected function getClassAnnotations($namespace)
    {
        $ary = array(
            'controller' => $this->getControllerAnnotations($namespace),
            'action'     => $this->getActionAnnotations($namespace),
        );
        return $ary;
    }

    /**
     * @Name:getActionAnnotations
     * @Description:
     * @Author:wangyu
     */
    protected function getActionAnnotations($namespace)
    {
        $cls = new \ReflectionClass($namespace);
        $methods =  $cls->getMethods( \ReflectionMethod::IS_PUBLIC );
        $ary = array();
        foreach($methods as $method){
            $fns  = new \ReflectionMethod($method->class , $method->name);
            $comments = $fns->getDocComment();
            if($annotations = $this->getAnnotations($comments)){
                $ary[] = $annotations;
            }
        }
        return $ary;
    }

    /**
     * @Name:getControllerAnnotations
     * @Description:
     * @Author:wangyu
     */
    protected function getControllerAnnotations($namespace)
    {
        $cls = new \ReflectionClass($namespace);
        $classComments = $cls->getDocComment();
        $annotations = $this->getAnnotations($classComments);;
        return $annotations;

    }

    /**
     * @Name:getAnnotations
     * @Description:
     * @Author:wangyu
     * @param $str
     * @return array()
     */
    private function getAnnotations($str)
    {

        if(strpos($str , '@') === false){
            return null;
        }
        $str = trim($str , "\/\/* \r\n");
        $ma = "{
            (?<=@)([^:]+)(?:[:])(.*?)(?<=$)
        }xm";
        preg_match_all($ma , $str , $matches);
        foreach($matches[1] as $k=>$v){
            $ary[trim($v)] = trim($matches[2][$k]);
        }
        return $ary;

    }

    /**
     * 构造用户菜单
     */
    private function buildMenu()
    {
        $where = ['fid' => 0];
        $top = $this->powers->where($where)->order('sort asc')->select();

        $where = ['fid' => ['neq' , 0] , 'HideInMenu' => 0];
        $second = $this->powers->where($where)->order('sort asc')->select();

        foreach($top as $k => $v) {
            foreach($second as $b) {
                if($b['fid'] == $v['id']){
                    $top[$k]['menu'][] = $b;
                }
            }
        }
        $this->assign('menus' , $top);
    }


    /**
     * 构造面包屑
     */
    private function buildBread()
    {
        $bread = [];
        $cur = strtolower(CONTROLLER_NAME.'/'.ACTION_NAME);
        $this->assign('currentPath' , $cur);
        $where = ['url' => $cur];
        $curPower = $this->powers->field('name , fid')->where($where)->find();
        if(!$curPower){
            $bread['parName'] = '未知';
        }
        $bread['curName'] = $curPower['name'];
        $where = ['id' => $curPower['fid']];
        $parPower = $this->powers->where($where)->getField('name');
        if($parPower){
            $bread['parName'] =  $parPower;
        }

        $this->assign('bread' , $bread);
    }

    /**
     * 构造提示消息
     * @param string $msg
     * @return string
     */
    protected function buildMsg($msg = '没有找到该数据')
    {
        $html = '<div style="width: 100%;text-align: center;font-size: 18px;">';
        $html .= $msg;
        $html .= '</div>';
        return $html;
    }


    /**
     * 删除目录下面的文件
     * @param $dir
     */
    protected function unlink($dir)
    {
        $file = $this->readDir($dir);
        foreach($file as $v) {
            if(is_dir($v)){
                $this->unlink($v);
            }else{
                $cs = session('cache');
                if($cs){
                    $files = array_merge($cs , array($v));
                }else{
                    $files = array($v);
                }
                session('cache' , $files);
                unlink($v);
            }
        }

    }

}