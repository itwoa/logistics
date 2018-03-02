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

    public function sendMsg(){

       
        $to_uid = "";
        
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $push_api_url =  $protocol.$_SERVER['HTTP_HOST'].":2121/";
        $post_data = array(
           "type" => "publish",
           "content" => "这个是推送的测试数据132",
           "to" => $to_uid, 
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $push_api_url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Expect:"));
        $return = curl_exec ( $ch );
        curl_close ( $ch );
        var_export($return);
    }
    
}
