<?php
namespace app\common\model;
use think\Model;

class Goods extends Model
{
	protected $resultSetType = 'collection';

	/*获取全部用户*/
	public function getGoods(){

		$list = $this->select();
		
		if($list){
			return $list->toArray();
		}else{
			return '';
		}
		
	}
}


?>