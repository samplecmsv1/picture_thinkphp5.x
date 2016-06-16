<?php  namespace tp\mongo;
use tp\helpers\arr;

/*
 * mongo db数据库操作
 * 查寻手册 
 * http://php.net/manual/en/mongocollection.findone.php
 * 
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 */

class  db{
	protected $db;
	protected $collection;
	
	static $server;
	static $options;



	function __construct(){
		$server = static::$server;
		$options = static::$options;
		$db = $options['db'];
		unset($options['db']);
		$client = new \MongoClient($server , $options); 
		$this->db = $client->selectDB($db);
	}	
	
	
	function insert($data = []){ 
		$keys = array_keys($data);
		if(!$keys){
			$keys = array_keys($collection);
		}

		$flag = true;
		foreach($keys as $v){
			if(!is_numeric($v)){
				$flag = false;
			}
		}
		if($flag === true){
			return $this->collection->batchInsert($data);
		}else{
			$this->collection->insert($data);	
			return $data['_id'];
		}
	}
	 
	
	function updateAll($condition,$set_or_inc = [],$par = [] ){
			$par['multiple'] = true;
			return $this->update($condition,$set_or_inc,$par);

	 
	}
	function update($condition,$set_or_inc = [],$par = array('multiple'=>false)){
			if(strpos(arr::get($set_or_inc,0)['k'],'$')===false){
				$set_or_inc = ['$set'=>$set_or_inc];
			}
			return $this->collection->update($condition,$set_or_inc , $par);;
	}
	
	
	function table($table){
		$this->collection = $this->db->$table;
		return $this;
	}
	
	function collection($table){
		$this->table($table);
		return $this;
	}
	
  	function order_by($order){
  			if(!$order)  return;
  			$o['desc'] = -1;
  			$o['asc'] = 1;
  			if($order){
  				foreach($order as $k=>$v){
  					if($o[$v]) $v = $o[$v];
  					$new[$k] = $v;
  				}	
  				$order = $new;
  			}
  			$this->ar['sort'] = $order;	
  			return $this->collection->sort($order);;
  	} 
 	
	
	function __call($method,$arg = []){ 
 	   return call_user_func_array([$this->collection, $method],$arg);
    }
	
	
	
}



