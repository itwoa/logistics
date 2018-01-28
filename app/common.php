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

/**
 * 简化print_t函数，传递数据以易于阅读的样式格式化后输出
 */
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 15px 10px;;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}

/**
 *  通过数组索引返回数组值
 */

function trance_str($array,$value){

	return $array[$value];
}
/**
	 * [ajaxUploadFile 上传文件]
	 * @param  [type] $folder   [文件夹名称]
	 * @param  [type] $filename [文件名，file的name]
	 *
	 */
function ajaxUploadFile($folder,$filename){
	header('Content-Type:application/json; charset=utf-8');
	//初始化数据
	$suffix = strtolower(pathinfo($_FILES[$filename]['name'],PATHINFO_EXTENSION));//文件后缀
	$allowType = array('png','jpg','gif','jpeg','pjpeg','doc','docx','xls','xlsx');//允许的上传类型
	$maxsize = 2000000;//最大上传值 2*1024*1024 = 2M
	$filesize = $_FILES[$filename]['size']; //获取上传文件的大小
	$filetype = $_FILES[$filename]['type'];

	if($filesize > $maxsize){

		$data = array("status" => 4,'msg'=>'上传文件超出限制！');
		exit(json_encode($data));
		return false;
	}

	if(!in_array($suffix, $allowType)){
		$data = array("status" => 3,'msg'=>'上传类型不允许！');
		exit(json_encode($data));
		return false;
	}

	$suffix = explode(".",$_FILES[$filename]['name']);
	$new_filename = date('YmdHis').rand(1000,9999).'.'.$suffix[1];
	$Upload_dir = "Upload/" .$folder."/".date("Ymd")."/";
	if(!file_exists($Upload_dir))mkdir($Upload_dir,0777);

	if(move_uploaded_file($_FILES[$filename]["tmp_name"],$Upload_dir.$new_filename)){
		//返回数据
		$data = array(
			"status" => 1,
			"imgurl" => $Upload_dir.$new_filename,
			'size' => $filesize
		);
		exit(json_encode($data));
	}else{

		$data = array("status" => 2,'msg'=>"上传失败");	//上传失败
		exit(json_encode($data));
	}

}

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

/*
 * PHPExcel 数据导出
 * @parm $fileName 文件名称
 * @parm $headArr Excel表头字段值 array()
 * @parm $data 导出的数据 array()
 *
 */

function getExcel($fileName,$headArr,$data){
    //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
    vendor('Excel.PHPExcel');
	vendor('Excel.PHPExcel.Write.Excel5.php');
	vendor('Excel.PHPExcel.IOFactory.php');

    $date = date("Y.m.d",time());
    $fileName .= "_{$date}.xls";

    //创建PHPExcel对象，注意，不能少了\
    $objPHPExcel = new \PHPExcel();
    $objProps = $objPHPExcel->getProperties();
	$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);

	$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(11,2);
    //设置表头
    $key = ord("A");
    //print_r($headArr);exit;
    foreach($headArr as $k=> $v){
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
        $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);

		$cellName  = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		$objPHPExcel->getActiveSheet()->getStyle($cellName[$k].'1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
		$objPHPExcel->getActiveSheet()->getStyle($cellName[$k].'1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中
		$objPHPExcel->getActiveSheet()->getStyle($cellName[$k].'1')->getFont()->setBold(true);//字体加粗

        $key += 1;
    }

    $column = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();

	$idString = '';
    foreach($data as $key => $rows){ //行写入
        $span = ord("A");
        foreach($rows as $keyName=>$value){// 列写入
            $j = chr($span);
            $objActSheet->setCellValue($j.$column, $value);
            $span++;
        }
        $column++;
		$idString .= ','.$rows['id'];
    }

    $fileName = iconv("utf-8", "gb2312", $fileName);

    //重命名表
    //$objPHPExcel->getActiveSheet()->setTitle('test');

    //设置活动单指数到第一个表,所以Excel打开这是第一个表
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();//清除缓冲区,避免乱码
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=\"$fileName\"");
    header('Cache-Control: max-age=0');

    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output'); //文件通过浏览器下载

	exit;
}