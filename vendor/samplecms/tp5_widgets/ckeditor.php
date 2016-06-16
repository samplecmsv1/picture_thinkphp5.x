<?php 
namespace tp\widgets;
/**
* 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
*/
class ckeditor extends base{

	function run(){
		 

	}
	
	function load(){


		$baseUrl = $this->asssets('ckeditor');


		$this->scriptLink = [
				$baseUrl.'ckeditor.js',
				$baseUrl.'lang/zh-cn.js'
		];
		$this->script[] = "
			
			$('#submit').click(function(){
				$('#".$this->ele."').val(CKEDITOR.instances.".$this->ele.".getData());
			});
			CKEDITOR.replace( '".$this->ele."');
			 
		";
		
	}
	
}
