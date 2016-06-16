<?php
namespace app\content\models;

class Pics extends Base{
	public $title = "图片";
	public $tb = 'pics';
	//public $tbVersion 	;

	public $fields = [
	 	
	 	 
	 	'file'=>[
	 		'label'=>'文件',
	 		'element'=>'file',
	 		
	 	],  

	 	'category'=>[
	 		'label'=>'分类',
	 		'element'=>'category',	 		 
	 	],

	 	'body'=>[
	 		'label'=>'内容',
	 		'element'=>'textarea',
	 		
	 	],

	 ];
	  
	/**
	 * INT类型的字段说明
	 * @var unknown
	 */
	public $int = [
			'status'
	];
	/**
	 * 验证规则 
	 * @var unknown
	 */
	public $validate = [
		'title'  => 'required',
		'body'  => 'required',
		//'slug'=>'required|unique(posts,slug)',
	];
	/**
	 * 验证错误提示信息
	 * @var array $validateMessage
	 */
	public $validateMessage = [
		'title'  => [
					'required'=>'标题不能为空啊啊',
				],
		'body'  => [
					'required'=>'内容不能为空',
			],
		 
		 
	];
	
	 
	
	
}