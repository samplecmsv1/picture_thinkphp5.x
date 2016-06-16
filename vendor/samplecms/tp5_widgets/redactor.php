<?php
namespace tp\widgets;
/**
 *  
 * 
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 *
 */
 
class redactor extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('redactor');
		$this->scriptLink[] = $baseUrl.'redactor.js';
		$this->cssLink[] = $baseUrl.'redactor.css';
		$this->script[] = "
			
				$('".$this->ele."').redactor({
					fixed: true
				});
			";
		
	}
	
}

 