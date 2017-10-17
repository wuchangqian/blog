<?php
namespace Tools\Controller;

use Think\Controller;

class ValidController extends Controller
{
    public function code()
    {
        $config =    array(
            'fontSize'    =>    18,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    true, // 关闭验证码杂点
            'imageH'      =>    41,
            'imageW'      =>    120,
            'useCurve'    =>    false,
            'length'      =>    4,
            'codeSet'     =>    '0123456789',
        );

        $Verify = new \Think\Verify($config);

        $Verify->entry();
    }
}