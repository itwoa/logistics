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
        $list = model('admin')->getUser();
 
      
    	return view();
    }


    public function home(){
    	$id = input('id');
    	$this->assign('title','后台首页');
    	$this->assign('id',$id);
    	return view();
    }
    
}
