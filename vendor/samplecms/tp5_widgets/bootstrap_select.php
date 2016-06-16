<?php
namespace tp\widgets;
/**
 *  http://silviomoreto.github.io/bootstrap-select/
 * 
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 *
 */
 
class bootstrap_select extends base{

	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('bootstrap-select');
		 
		$this->scriptLink[] = $baseUrl.'dist/js/bootstrap-select.min.js';
		$this->cssLink[] = $baseUrl.'dist/css/bootstrap-select.min.css';
 		if(!$this->option){
			 $this->option = [
			 	'style'=>'btn-success'	,
			 ];
 		}
 		$op = $this->toJson($this->option);
		 $this->script[] = "$('.select').selectpicker(".$op.");";
		
	}
	
}

 