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
        echo model('User','logic')->test();
        //print_r($list);
    	return view();
    }


    public function home(){
    	$id = input('id');
    	$this->assign('title','后台首页');
    	$this->assign('id',$id);
    	return view();
    }

    public function sendMsg(){
        $time = date('m/d H:i',time());
        $to_uid = "";    
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        //$push_api_url =  $protocol.$_SERVER['HTTP_HOST'].":2121/";
        $push_api_url =  $protocol.$_SERVER['HTTP_HOST'].":2121/";
        $post_data = array(
           "type" => "publish",
           "content" => "<p>办公室牛牛 ".$time." 发布了一条公告：<a class='see'>元宵节提前下班通知</a></p>",
           "link" => url('notice/content',array('id'=>3)),
           "msid" => 3,
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

        switch ($return) {
            case 1:
                $msg = '推送成功！';
                break;
            case 2:
                $msg = '用户已离线！';
                break;
            case 0:
                $msg = '推送失败！';
                break;
            default:
                $msg = '推送失败！';
                break;   
        }
        
        
        //记录失败日志
        //logs($msg.'-datas：'.json_encode($post_data),'workerman');
        
    }
    
}
