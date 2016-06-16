<?php
namespace tp\widgets;
/**
 *  
 * 
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 *
 */
 
class bootstrap_switch extends base{

	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('bootstrap-switch');
		 
		$this->scriptLink[] = $baseUrl.'dist/js/bootstrap-switch.js';
		$this->cssLink[] = $baseUrl.'dist/css/bootstrap3/bootstrap-switch.css';
 
		 
		 $this->script[] = "$(\".checkbox\").bootstrapSwitch();";
		
	}
	
}

 