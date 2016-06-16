<?php
namespace tp\widgets;
/**
 *  
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 *
 */
 
class bootstrap extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('bootstrap');
		$this->scriptLink[] = $baseUrl.'js/bootstrap.js';
		$this->cssLink[] = $baseUrl.'css/bootstrap.css';
		

		/*$this->script[] = "
			
				$('".$this->ele."').redactor({
					fixed: true
				});
			";*/
		
	}
	
}

 