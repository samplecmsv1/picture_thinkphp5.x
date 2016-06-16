<?php
namespace app\content\models\core;
/**
 * composer require alexgarrett/violin
 * @author sun kang
 *
 */

class validate{
	public $validateObj;
	public $validate = [
		//'title'  => 'required',
		//'body'  => 'required|int',
	];
	public $validateMessage = [
		//	'username' => [
		//			'required' => 'You need to enter a username to sign up.'
		//	],
		//	'age' => [
		//			'required' => 'I need your age.',
		//			'int'      => 'Your age needs to be an integer.',
		//	]
			
	];
	public $allowFields;
	
	function __construct(){
		if(class_exists('overwrite\models\validateViolinExt')){ 
			$this->validateObj =  new \overwrite\models\validateViolinExt;
		}else{
			$this->validateObj = new validateViolinExt;
		}
		
		
	}
	
	
	
	/**
	 * 验证数据
	 * @param unknown $data
	 */
	function validate(){
		if($this->validate){
			foreach($this->validate as $k=>$v){
				$value = trim($_POST[$k]);
				$data[$k] = [$value,$v];
			}
		}
		$this->validateMessage();
		$this->validateObj->addFieldMessages($this->validateMessage);
		$this->validateObj->validate($data);
		if($this->validateObj->passes()) {
			return;
		} else {
			return $this->validateObj->errors()->all();
		}
	}
	
	function validate_message(){
		return $this->validateObj->errors()->all();
	}
	
	protected function validateMessage(){
		$lang = $this->validateObj->lang();
		$this->validateObj->addRuleMessages($lang);
	}
	
}