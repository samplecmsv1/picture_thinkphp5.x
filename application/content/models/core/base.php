<?php
/**
 * @author  SUN KANG [sunkang@wstaichi.com]
 * @copyright 
 * @version 1.0
 */

namespace app\content\models\core;
use cms\db;
 
class  base extends validate{
	
	public $tb;
	public $int = [];
	public $allowFields = [];
	public $data = [];
	public $ignoreFiles = [];
	function __construct(){
		parent::__construct();
		if($this->int){
			foreach($this->int as $v){
				$_POST[$v] = (int)$_POST[$v]?:0;
				$_GET[$v] = (int)$_GET[$v]?:0;
			}
		}
		$this->init();
	}
	function init(){
		
	}
	
	/**
	 * 忽略字段
	 * @param unknown $ignoreFiles
	 */
	function ignore($ignoreFiles){
		$this->ignoreFiles = $ignoreFiles;
		foreach($this->validate as $k=>$v){
			if(in_array($k,$ignoreFiles)){
				unset($this->validate[$k]);
			}
		}
	}
	
	function _arrayToString($arr){
		if(!$arr){
			return;
		}
		foreach($arr as $k=>$v){
			$str .=$k."=".$v." ,";
		}
		return substr($str,0,-1);
			
	}
	
	function _log($str){
		$str .= "IP: ".ip()." User ID:".cookie('adminId')." UserName:".cookie('adminUser');
		//log_sys($str);
	}
	
	
	  
	
	/**
	 * 验证数据是否为设置好的字段
	 * @param unknown $data
	 * @return unknown[]
	 */
	protected function filterData($data){
		$Fdata = [];
		$allow = $this->allowFields;
		$ignore = $this->ignoreFiles;
		
		foreach($data as $k=>$v){
			if($ignore && in_array($k,$ignore)){
				continue;		
			}
			if(in_array($k,$allow)){
				if(is_string($v)){
					$v = trim($v);
				}
				$Fdata[$k] = $v;
			}
		}
		return $Fdata;
	}
	 

	 
	function data($data){
		return  $this->filterData($this->data+$data);
	}




	/**
	 * 更新全部数据
	 * @param 条件 $condition
	 * @param 更新的数组 $setData
	 */
	public function updateAll($condition = null,$setData = null){
		return $this->update($condition,$setData,true);
	}
	/**
	 * beforeUpdateValidate($data),beforeSaveValidate
     *
	 * @param unknown $condition
	 * @param unknown $setData
	 */
	public function updateValidate($condition = null,$setData = null){
		if(method_exists($this,'beforeUpdateValidate')){
			$this->beforeUpdateValidate($setData);
		}
		if(method_exists($this,'beforeSaveValidate')){
			$this->beforeSaveValidate($setData);
		}
		$e = $this->validate();
		if($e){
			return [
					'errors'=>implode("<br>",$e),
			];
		}
		return  $this->update($condition,$setData,false);
	}
	/**
	 * 更新数据  beforeUpdate($setData,$condition) ,afterUpdate($updatedExisting,$setData),beforeSave,afterSave
	 * @param 条件 $condition
	 * @param 更新的数组 $setData
	 * @param string $updateAll
	 */
	public function update($condition = null,$setData = null,$updateAll = false){
		if(method_exists($this,'beforeUpdate')){
				$this->beforeUpdate($setData,$condition);
		}
		if(method_exists($this,'beforeSave')){
			$this->beforeSave($setData,$condition);
		}
				if(!$condition){
					$condition  = ['_id'=>new \MongoId($_GET['id'])];
				}
				if(!$setData){
					$setData = $_POST;
				}
				$setData = $this->filterData($this->data+$setData);
				if(!$setData){
					return false;
				}
				$setData['updated'] = new \MongoDate();
				
				if($updateAll){
					$log = "All ";
				}
				$this->_log(
					'Update '.$log.' Collection: ['.$this->tb.'],Condition: '.
					 $this->_arrayToString($condition)." ".
					 "Data:".$this->_arrayToString($setData)." "
				);
				$updatedExisting =  db::get($this->tb)->update(
						$condition,
						['$set' => $setData],
						['multiple' => $updateAll===true?true:false]
						)['updatedExisting'];
				
				 
				return $updatedExisting;
	
	}
    
	/**
	 * beforeInsertValidate($data),beforeSaveValidate
	 * 更改 $this->validate = []
	 * 
	 * @param array $data
	 */
	public function insertValidate($data = []){
		if(method_exists($this,'beforeInsertValidate')){
			$this->beforeInsertValidate($data);
		}
		if(method_exists($this,'beforeSaveValidate')){
			$this->beforeSaveValidate($data);
		}
		$e = $this->validate();
		if($e){ 
			return [
					'errors'=>implode("<br>",$e),
			];
		}
		return $this->insert($data);
	}
	/**
	 * 写入数据  beforeInsert($data) , afterInsert($upserted,$data) ,afterSave
	 * @param array $data
	 */
	public function insert($data = []){
		if(method_exists($this,'beforeInsert')){
			$this->beforeInsert($data);
		}
		if(method_exists($this,'beforeSave')){
			$this->beforeSave($data);
		}
		
		$data = $this->filterData($this->data+$data);
		if(!$data){
			return false;
		}
		 
		$data['created'] = new \MongoDate();
		$data['updated'] = new \MongoDate();
		
		$this->_log(
				'Insert Collection: ['.$this->tb.'],'.
				"Data:".$this->_arrayToString($data)." "
				);
		
		return db::get($this->tb)->insert($data);
		
		 
	}
	
	/**
	 * 直接以_id显示数据
	 */
	public function view(){
		$id = $_GET['id'];
		return $this->findOne(['_id'=>new \MongoId($id)]);
	}
	/**
	 * 计数COUNT
	 * @param unknown $condition
	 */
	public function count($condition = null){
		return db::get($this->tb)
				->count($condition);
	}
	/**
	 * 查寻数据 
	 * $par[
	 * 	'sort'=> ['created' => -1 ] ,
	 *	'skip'=> [$pageArray['offset']],
	 *	'limit'=>$size,
	 * ]
	 * @param 条件 $condition
	 * @param array|排序 limit等 $par
	 */ 
	public function find($par = [] ){
		$condition = $par['condition']?:[];
		unset($par['condition']);
		$mo = db::get($this->tb);
		$mo = $mo->find($condition);
		if($par){
			foreach ($par as $k=>$v){
				$mo = $mo->$k($v);
			}
		}
		return $mo;
	}
	/**
	 * 查寻一条记录
	 * @param 条件 $condition
	 */
	public function findOne($condition){
		return db::get($this->tb)->findOne($condition);
	}
	public function one($condition){
		return $this->findOne($condition);
	}
	/**
	 * 删除数据 
	 * @param 条件 $condition
	 */
	public function remove($condition = null){
		$mo = db::get($this->tb);
		
		$this->_log(
				'Remove Collection: ['.$this->tb.'],'.
				"Condition:".$this->_arrayToString($condition)." "
				);
		
		return $mo->remove($condition);
	}
	/**
	 * 分页
	 * $data = $this->obj->page([
	 *			'url'=>'/posts',
	 *			'size'=>10,
	 *			'sort'=>[
	 *				'created'=>-1
	 *			],
	 *			'condition'=>[
	 *				'status'=>1	
	 *			],
	 *	]);
	 *	return view('post',$data);
	 * @param array $par
	 */
	public function pager($par = []){
		return db::pager($this->tb,$par);
	}
	 
	 
	
	
	
}