<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;
use think\Validate;
/*用户管理员*/
class Member extends Common
{
	protected $rule = [
        'tag_id'   => 'require|number|token',
    ];

    protected $message = [
        'tag_id.require'   => '请选择标签类型',
        'tag_id.token'      => '不能重复提交'
    ];

	//管理员首页
    public function index(){
    	$list = db('admin')->paginate(5);

    	// 获取分页显示
		$page = $list->render();
		
		$this->assign('page', $page);
    	$this->assign('list',$list);
        $this->assign('title','管理员');
        return view();
    }

    //添加管理员
    public function add(){

    	return view();
    }

    //创建数据
    public function creat(){
    	$request = request();
    	$data = $request->post();

    	if($data['pwd'] != $data['sure_pwd']){
    		$this->error('两次密码输入不一致！');
    	}
    	unset($data['sure_pwd']);

    	$validate = validate('Admin');

    	if(!$validate->check($data)){
		    // dump($validate->getError());
		    $this->error($validate->getError());
		}

		$data['pwd'] = md5($data['pwd']);
    	unset($data['__token__']);

    	$res = db('admin')->insert($data);

    	if($res){
    		$this->success('添加成功！',	url('index'));
    	}else{
    		$this->error('添加失败！');
    	}

    }
}
