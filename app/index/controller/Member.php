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
        $show = input('show')?:0;
        
        $where = [];
        if($show == 0){
            $where['status'] = 1;
        }  
    	$list = db('admin')->where($where)->paginate(5);

    	// 获取分页显示
		$page = $list->render();

        $this->assign('show', $show);
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

    //管理员编辑
    public function edit(){
    	$id = input('id');

    	$info = db('admin')->where('id',$id)->find();

    	$accType = config('sys.admin_name');
    	$accTttr = config('sys.admin_attri');
    	unset($accType[0]);
    	$this->assign('accType',$accType);
    	$this->assign('accTttr',$accTttr);
    	$this->assign('info',$info);
    	return view();
    }

    //编辑更新
    public function creatUpdate(){

    	$request = request();
    	$data = $request->post();

    	if($data['pwd'] == ''){
    		unset($data['pwd']);
    	}else{

    		if($data['pwd'] != $data['sure_pwd']){
    		$this->error('两次密码输入不一致！');
    		}
    		$data['pwd'] = md5($data['pwd']);
    	}

    	unset($data['sure_pwd']);

    	$validate = validate('Admin');

    	if(!$validate->check($data)){
		    $this->error($validate->getError());
		}

    	unset($data['__token__']);

    	$res = db('admin')->update($data);

    	if($res){
    		$this->success('修改成功！',	url('index'));
    	}else{
    		$this->error('修改失败！');
    	}

    }

    //管理员删除
    public function memberDel(){
    	$id = input('id');

    	if($id == 1){
    		$this->error('总管理员不允许删除！');
    	}

    	$res = db('admin')->delete($id);

    	if($res){
    		$this->success('删除成功！');
    	}else{
    		$this->error('删除失败！');
    	}


    }
}
