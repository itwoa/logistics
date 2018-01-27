<?php
namespace app\common\model;
use think\Model;

class Admin extends Model
{
	protected $resultSetType = 'collection';

	/*获取全部用户*/
	public function getUser(){

		$list = $this->select();
		
		if($list){
			return $list->toArray();
		}else{
			return '';
		}
		
	}
}


?>