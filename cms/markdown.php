<?php
namespace cms;
/**
 * composer require erusev/parsedown
 *
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2016
 */
class markdown{
	 
	function text($text){
		 $Parsedown = new Parsedown();

		 return $Parsedown->text($text); 
	}
	



}
