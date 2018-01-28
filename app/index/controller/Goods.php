<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;
use think\Validate;

/*物品管理*/
class Goods extends Common
{
	//列表页
    public function index()
    {

   		$list = db('goods')->order("sort asc")->select();
   		$data = parseTree($list);

    	$this->assign('list',$data);
        $this->assign('title','物品管理');
        return view();
    }

   	//添加物品
   	public function addGoods(){

   		return view();
   	}
   	//添加数据
   	public function creat(){
   		$request = request();
    	$data = $request->post();

    	$validate = new Validate([
		    'namee'  => 'require|max:25'
		]);

    	if (!$validate->check($data)) {
    		$this->error($validate->getError());
		}

    	unset($data['__token__']);
    	$res = db('goods')->insert($data);
    	if($res){
    		$this->success('添加成功！',url('index'));
    	}else{
    		$this->error('添加失败！');
    	}

   	}
   	//添加子分类
   	public function addchild(){

   		$pid = input('id');
   		$info = db('goods')->where('id',$pid)->find();

   		$this->assign('info',$info);
   		return view();
   	}

   	//编辑物品分类
   	public function edit(){
   		$id = input('id');
   		$info = db('goods')->where('id',$id)->find();

   		//物品的一级分类
   		$goods = db('goods')->where('pid',0)->select();

   		$this->assign('info',$info);
   		$this->assign('goods',$goods);
   		return view();
   	}
   	//更新操作
   	public function creatUpdate(){

   		$request = request();
    	$data = $request->post();

    	$validate = new Validate([
		    'namee'  => 'require|max:25'
		]);

    	if (!$validate->check($data)) {
    		$this->error($validate->getError());
		}

    	unset($data['__token__']);
    	$res = db('goods')->update($data);
    	if($res){
    		$this->success('修改成功！',url('index'));
    	}else{
    		$this->error('修改失败！');
    	}
   	}

   	//删除分类
   	public function goodsDel(){
   		$id = input('id');

   		$info = db('goods')->where('pid',$id)->find();

   		if($info){
   			$this->error('该分类下有子分类，不允许删除！');
   		}

   		$res = db('goods')-delete($id);
   		if($res){
   			$this->success('删除成功！');
   		}else{
   			$this->error('删除失败！');
   		}

   	}
}
