<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;
/*用户管理员*/
class Member extends Common
{
	//管理员首页
    public function index(){
        
        $this->assign('title','管理员');
        return view();
    }

    //添加管理员
    public function add(){

    	return view();
    }

   
}
