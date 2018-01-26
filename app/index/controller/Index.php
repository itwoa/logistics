<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;

class Index extends Controller
{
    public function index()
    {
       
        echo config('SYS.UP_MAX_SIZE');
        return $this->fetch();
    }

    //登录
    public function login()
    {
        if (Request::instance()->isPost()) {

            $account = input('username', 0, 'trim');
            $password = input('password', 0, 'trim');
            //验证码
            $verify_code = input('passcode', '0', 'trim');
            $type = input('type');

            //验证验证码是否正确
            if(!captcha_check($verify_code)) {
                $data = [
                    'status' => 0,
                    'msg' => '验证码错误！',
                    'target' => 2
                ];
                exit(json_encode($data));
            }

            //验证用户名和密码
            $user = db('admin')->where("username = '".$account."'")->find();
            if(!$user || $user['pwd'] != md5($password)){
                $data = [
                    'status' => 0,
                    'msg' => '用户名或密码错误！',
                    'target' => 2
                ];
                exit(json_encode($data));
            }else{
                db('admin')->where('id', $user['id'])->update(['login_time' => time()]);
                //缓存登录数据
                session('nick', $user['nick']);
                session('adminid', $user['id']);
                session('username',$user['username']);
                session('lasttime', time());
                session('logintime',date("Y-m-d H:i",$user['login_time']));
                $data = [
                    'status' => 1,
                    'url' => '/home/'
                ];
                exit(json_encode($data));
            }


        }

    }

    /**
     * 退出登录
     */
    public function logout()
    {

        session(null);
        session_destroy();
        $this->success('', '/adms', '', 0);

    }
}
