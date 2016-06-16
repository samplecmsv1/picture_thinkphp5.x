<?php
namespace app\content\models;

class Category extends Base{
	public $title = "分类";
	public $tb = 'category';
	public $tbVersion = "version_category";
	public $fields = [
	 	 
	 	'pid'=>[
	 		'label'=>'上一级',
	 		'element'=>'category',
	 		'int'=>false,
	 	],

	 	
	 	'slug'=>[
	 		'label'=>'唯一标识',
	 		'element'=>'txt',
	 		'int'=>false,
	 	],


	 ];
	 
	
	public $int = [
		 'status'	
	];
	
	public $validate = [
		'title'  => 'required',
		'slug'  => 'required|unique(category,slug)',
	];
	
	public $validateMessage = [
		'title'  => [
					'required'=>'分类名不能为空',
				],
		'slug'  => [
				'required'=>'标识不能为空',
				'unique'=>'已存在标识',
		],
	];
	
	 
}