<?php
namespace tp\widgets;
/**  
 * 
 * @author SUN KANG
 *
 */
 
class  ajax_form extends base{

	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('ajax_from');
		 
		$this->scriptLink[] = $baseUrl.'jquery.form.js';
		 
		
	}
	
}

 