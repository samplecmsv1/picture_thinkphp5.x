<?php
namespace package\widgets;
/**
*如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
*/
 
class  editor extends base{
	
	
	function run(){
			
	}
	
	
	function load(){
		$baseUrl = $this->asssets('editor.md');
		 
		$this->scriptLink[] = $baseUrl.'editormd.min.js';
		$this->cssLink[] = $baseUrl.'css/editormd.min.css';
		
		if(!$this->ele){
			return;
		}
 		$this->option['path'] = $baseUrl.'/lib/';
 		$op = $this->toJson($this->option);
 		
 		 
 			$js = '
				var editor'.$this->id.' = editormd("'.$this->ele.'", '.$op.');
			';
 		 
		$this->script[] = $js;
		
	}
	
}

 