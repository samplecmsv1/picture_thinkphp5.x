<?php
namespace package\widgets;
/**
 *  
 * 
 * @author SUN KANG
 *
 */
 
class jui extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('jquery-ui');
		$this->scriptLink[] = $baseUrl.'jquery-ui.min.js';
		$this->cssLink[] = $baseUrl.'jquery-ui.css';
		
	}
	
}

 