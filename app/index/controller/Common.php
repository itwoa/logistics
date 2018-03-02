<?php
namespace app\index\controller;
use think\Controller;
use think\Config;
use think\Request;
use org\Auth;
use think\Db;

class Common extends Controller
{
    public function _initialize()
    {

    	if (empty(session('adminid'))) {
            $this->redirect('/');
        }

        //操作超时
        $times = time();
        $time_out = 3600;
        if ($times - session('lasttime') > $time_out) {
            
            session(null);
            session_destroy();

            if(request()->isAjax()){
                $this->error('长时间未操作请重新登录', '/');
            }else{
                echo "<script>alert('长时间未操作请重新登录');parent.window.location.href='/'</script>";
                //exit;
            }

        }else {
            session('lasttime', time());
        }

    }

}