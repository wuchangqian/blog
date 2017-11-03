<?php
/**
 * Created by PhpStorm.
 * User: wy
 * Date: 2017/10/30
 * Time: 16:41
 */

namespace Common\Model;


use Think\Model;
use Overtrue\Pinyin\Pinyin;

class PostsModel extends Model
{
    protected $_validate = [
        ['title','require','请输入文章标题'],
        ['cate','0' , '请选择分类' , 0 , 'notequal'],
        ['content','require' , '请输入内容']
    ];

    protected $_auto = [
        ['uid' , 'getUid' , 1 , 'callback'],
        ['tags' , 'getTags' , 3 , 'callback'],
        ['url' , 'getPinYin' , 3 , 'callback'],
        ['createtime' , 'time' , 1 , 'function'],
        ['updatetime' , 'time' , 2 , 'function']
    ];

    /**
     * 获取用户id
     * @return int
     */
    protected function getUid()
    {
        return get_uid() ? : 0;
    }

    /**
     * 获取标题拼音为seo
     * @return string
     */
    protected function getPinYin()
    {
        include_once('vendor/autoload.php');

        $pinyin = new Pinyin();

        return $pinyin->permalink($_POST['title'], '-');
    }


    /**
     * 构造标签列
     * @return string
     */
    protected function getTags()
    {
        $tags = $_POST['tags'];
        if(empty($tags)){
            return '';
        }
        $value = '|'.implode( '|' , $tags).'|';
        return $value;
    }
}