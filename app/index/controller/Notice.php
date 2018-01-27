<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;
/*公告*/
class Notice extends Common
{
	//公告首页
    public function index(){
        
        return view();
    }

    //发布公告
    public function addNotice(){

    	return view();
    }

    //公告详情
    public function content(){

    	return view();
    }
   
}
