<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Benny <695771215@qq.com>
// +----------------------------------------------------------------------

/*
 * 字符串截取，支持中文和其他编码
 *
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式 默认utf-8
 * @param string $suffix 截断字符串后缀
 * @return string
 *
 */


/**
 * 传递一个父级分类ID返回所有子级分类
 *
 */	
function getChilds($user,$pid){
	$arr = array();
	foreach($user as $v){
		if($v['pid'] == $pid){
			$arr[] = $v;
			$arr = array_merge($arr,getChilds($user,$v['id']));
		}
	}
	return $arr;
}

/**
 * 二维数组冒泡排序法
 *  $arr 要排序的数组
 *  $field 要排序的字段
 *  $rule 排序规则，asc或desc
	 */
function bubbleSort($arr,$field,$rule){
	//$tmp = array();
	for($i=0;$i<count($arr);$i++){
		for($j=1;$j<count($arr)-$i;$j++){
			//从大到小排序
			if($rule == 'desc'){
				if($arr[$j][$field] > $arr[$j-1][$field]){
					$tmp = $arr[$j-1];
					$arr[$j-1] = $arr[$j];
					$arr[$j] = $tmp;
				}
			}elseif($rule == 'asc'){
				//从小到大排序
				if($arr[$j][$field] < $arr[$j-1][$field]){
					$tmp = $arr[$j-1];
					$arr[$j-1] = $arr[$j];
					$arr[$j] = $tmp;
				}
			}
		}
	}

	return $arr;
}

/**
 * https请求 （GET、POST）
 * @param  string $url  请求地址
 * @param  array $data 请求数据
 * @return [type]       [description]
 */
function httpsRequest($url, $data){

      $curl = curl_init();

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec($curl);
      curl_close($curl);
      return $output;
}

/**
 * 下载文件
 * @param  [type] $url      文件地址
 * @param  [type] $fileName 文件名
 * 
 */
function download($url,$fileName){
	ob_end_clean();
	$file = file_get_contents($url);
	header("Content-type: image/png");
	header('content-disposition:attachment;filename='.$fileName);
	header('content-length:'.strlen($file));
	readfile($url);
}

/*
 *
 * 删除某个目录下的所有文件，不删除目录
 * @$parm $dir 目录地址
 *
 */

function clearFile($dir) {
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }
}

/*
 * 随机字符串
 * @parm 字符串的长度，默认10
 *
 */

function randomStr($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
 }

function substrExt($str, $start=0, $length,$suffix="",$charset="utf-8"){

	if(function_exists("mb_substr")){
		 return mb_substr($str, $start, $length, $charset).$suffix;
	}
	elseif(function_exists('iconv_substr')){
		 return iconv_substr($str,$start,$length,$charset).$suffix;
	}

	$re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";

	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	return $slice.$suffix;

}

/**
 * 无限极分类
 * @param  [type] $items [description]
 * @return [type]        [description]
 */
function generateTree($items){
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['child'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}

/**
 * 无限极分类，与上方法相同，代码更简洁
 * @param  [type] $items [description]
 * @return [type]        [description]
 */
function generateTrees($items){
    foreach($items as $item)
        $items[$item['pid']]['child'][$item['id']] = &$items[$item['id']];
    return isset($items[0]['child']) ? $items[0]['child'] : array();
}

/**
 * 无限极分类树（非递归）
 * @param  [type] $rows [description]
 * @return [type]       [description]
 */
function parseTree($rows) {
	$rows = array_column ($rows, null, 'id' );
	foreach ($rows as $key => $val ) {
	    if($val ['pid']) {
			if (isset($rows [$val ['pid']])){
	           $rows[$val ['pid']]['child'][] = &$rows[$key];
	        }
	    }
	}
	//删除多余的数组
	foreach($rows as $key => $val) {
	    if($val['pid']) unset ($rows[$key]);
	}
	return $rows;
}

/**
 * 无限极分类递归
 * @param  [type] $a   [description]
 * @param  [type] $pid [description]
 * @return [type]      [description]
 */
function get_attr($a,$pid){  
    $tree = array(); 
    foreach($a as $v){  
        if($v['pid'] == $pid){                      
            $v['children'] = get_attr($a,$v['id']);  
            if($v['children'] == null){  
                unset($v['children']); 
            }  
            $tree[] = $v;    
        }  
    }  
    return $tree;  
}