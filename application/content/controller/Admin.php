<?php
namespace app\content\controller;

class Admin extends Base  {
	  
	 public $obj;
	 public $loginUrl = "/admin/login/index";
	 public $theme = 'admin';
	 
	 function init(){
	 	parent::init();
	 }
	 
	 function _check(){
	 	return cookie('adminId');
	 }
	 
	 
}
