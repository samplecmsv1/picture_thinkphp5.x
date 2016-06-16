<?php
namespace app\service\controller;
use package\verify as verify_class;
class Verify{
	 public $obj;
	 function __construct(){
	 	$this->obj  = new verify_class([
	 		'seKey'=>'abc',
	 		'useZh'=>false,
	 		'useImgBg'  =>  false,           // 使用背景图片 
	        'fontSize'  =>  16,              // 验证码字体大小(px)
	        'useCurve'  =>  false,            // 是否画混淆曲线
	        'useNoise'  =>  false,            // 是否添加杂点	
	        'imageH'    =>  0,               // 验证码图片高度
	        'imageW'    =>  0,               // 验证码图片宽度
	        'length'    =>  4,               // 验证码位数
	        'fontttf'   =>  '',              // 验证码字体，不设置随机获取
	        'bg'        =>  array(243, 251, 254),  // 背景颜色
	 	]);
	 }
	 function index(){
	 	return $this->obj->show(3);
	 }

	 function check(){
	 	$input = strtolower($_GET['verify']);
	 	$data['status'] = false;
	 	if($this->obj->check($input)){
	 		$data['status'] = true;
	 	}
	 	echo json_encode($data);
	 }
	
	
	
}