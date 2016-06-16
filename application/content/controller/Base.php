<?php
namespace app\content\controller;
class Base extends \cms\base  {
	protected $id;
	protected $action;
	protected $module;
	/**
	 * 无权限时跳转的URL
	 */
	public $loginUrl = "admin/login/index";
	/**
	 * 权限控制
	 *　值可以为 当前的action也可以是完整的module.id.action或id.action
	 */
	public $accessDeny = [];
	/**
	 * 可重新定义该函数,实现权限检测
	 */
	function _check(){
		return cookie('id');
	}
	
	function _access(){
		if(!$this->accessDeny) return true;
		foreach($this->accessDeny as $v){
			if($v=='*'){
				if(!$this->_check()){
					redirect(url($this->loginUrl));
				}
				goto End;
			}else{
	
				$arr = explode('.',$v);
				$i = count($arr);
				$module = $this->module;
				$id = $this->id;
				$action = $this->action;
				switch($i){
					case 1:
						$check1 = $this->module.".".$this->id.".".$arr[0];
						if($arr[0]=="*"){
							$action = "*";
						}
						break;
					case 2:
						$check1 = $this->module.".".$arr[0].".".$arr[1];
						if($arr[1]=="*"){
							$action = "*";
						}
						if($arr[0]=="*"){
							$id = "*";
						}
						break;
					case 3:
						$check1 = $arr[0].".".$arr[1].".".$arr[2];
						if($arr[2]=="*"){
							$action = "*";
						}
						if($arr[1]=="*"){
							$id = "*";
						}
						break;
				}
	
				$check = strtolower($module.".".$id.".".$action);
				if($check == $check1 && !$this->_check() ){
					redirect(url($this->loginUrl));
				}
			}
				
		}
		End:
		return true;
	
	}
	/**
	 *　构造函数
	 */
	function __construct(){
		parent::__construct();
		$this->module  = $this->request->module();
		$this->id = $this->request->controller();
		$this->action =  $template?:$this->request->action();
		$this->init();
		 
	}
	/**
	 *　渲染视图
	 */
	protected function  render($view,$data = []){
		/*theme(theme()?:$this->theme);
		$i = substr($view,0,1);
		if($i=='/'){
			$view = substr($view,1);
		}else{
			$view =  $this->module."/$view";
		}
		return view($view,$data);*/
	}
		
		
	/**
	 * 初始化
	 */
	function init(){
		
		$this->_access();
	}
	
	
}
