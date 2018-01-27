<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;
/*用户管理员*/
class Member extends Common
{
    public function index()
    {
        
        $this->assign('title','管理员');
        return view();
    }

   
}
