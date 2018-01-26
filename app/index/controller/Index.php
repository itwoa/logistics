<?php
namespace app\index\controller;
/*默认控制器*/

class Index
{
    
    public function index(){
        
        return view('index');
    }

    //登录提交
    public function login(){

    	$data = request()->param();
    	$pwerror = session('pwerror')?:0;
    	if(empty($data['username']) || empty($data['password'])){
    		$this->error('用户名密码不能为空！');
    	}

    	if(isset($data['checkcode']) && !captcha_check($data['checkcode'])) {
            $this->error('验证码不正确！');
        }

        $user = db('admin')->where("username = '".$data['username']."'")->find();

        if(!$user){
        	$this->error('用户名不存在！');
        }

        if(md5($data['password']) != $user['pwd']){
        	$pwerror ++;
        	session('pwerror',$pwerror);
        	$this->error('密码输入错误！');

        }

        session('username',$user['username']);
        session('logintime',$user['logintime']);
        session('nickname',$user['nickname']);
        session('pwerror',0);
        //写入登录时间
        db('admin')->where('id = '.$user['id'])->setField('logintime',time());
        $this->success('登录成功！',url('Index/home'));

    }
}
