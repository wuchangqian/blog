<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $mkParser = new \Org\Util\ParserMarkDown();

        $path = ROOT_PATH.'/posts/2017-09-19-laravel-learn-notes.markdown';

        $mktext = file_get_contents($path);

        $text = $mkParser->text($mktext);

        $this->show($text);
    }
}