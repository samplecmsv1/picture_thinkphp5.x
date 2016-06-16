<?php
namespace tp\widgets;
/**  
 * 
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 *
 */
 
class  font_awesome extends base{

	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('Font-Awesome-4.6.3');
		 
		$this->cssLink[] = $baseUrl.'css/font-awesome.css';
		 
		
	}
	
}

 