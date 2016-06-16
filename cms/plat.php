<?php
namespace  cms;
/**
* 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
*/
class plat{
	
	function is_weixin(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
			return true;
		}
		return false;
	
	}
	
	function is_android(){
		if ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') !== false ) {
			return true;
		}
		return false;
	}
	
	function is_iphone(){
		if ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone') !== false ) {
			return true;
		}
		return false;
	}
	
	function is_ipad(){
		if ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipad') !== false ) {
			return true;
		}
		return false;
	}
	
	
}