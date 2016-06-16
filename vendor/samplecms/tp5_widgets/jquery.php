<?php
namespace tp\widgets;
/**
 *  
 * 
 * @author SUN KANG
 *
 */
 
class jquery extends base{

	
	function run(){
		 	
	}
	
	
	function load(){
		$baseUrl = $this->asssets('jquery');
		$this->scriptLink[] = $baseUrl.'jquery.js';
		 
		
	}
	
}

 