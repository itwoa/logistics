<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;

/*后台主页面*/
class Home extends Common
{
    public function index()
    {
        
    	return view();
    }


    public function home(){
    	$id = input('id');

    	$this->assign('id',$id);
    	return view();
    }
    
}
