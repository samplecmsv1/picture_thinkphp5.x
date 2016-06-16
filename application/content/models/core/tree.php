<?php 
namespace app\content\models\core;
use cms\tree as TreeHelper;
class tree extends  base{
	/**
	 * 表单中的树，可以选任意节点
	 * 生成option
	 * 字段  id title pid
	 * @param array $all
	 */
	function getTree($selectValue = null){
		$all = $this->find([]);
		foreach($all as $v){
			$new[] = (object)[
					'id'=>(string)$v['_id'],
					'title'=>$v['title'],
					'pid'=>$v['pid']?:0,
			];
		}
		$new = TreeHelper::toTree($new,0,$selectValue);
		return $new;
	}
	
	/**
	 *  生成列表可以分得清的层级关系
	 *  字段  id title pid
	 * @var unknown
	 */
	static $_treeList_baseModel;
	static $_treeList_baseModel_I = 0;
	static function tableTree($arr,$pid = 0 ,$span = "&nbsp"){
		if(!$arr){
			return;
		}
		if(is_array($arr)){
			foreach($arr as $v){
				if($v['pid'] == $pid){
					static::$_treeList_baseModel[] = $v;
					static::_tableTreeHelper($arr,$v);
				}
			}
		}
		return static::$_treeList_baseModel;
	}
	
	static function _tableTreeHelper($arr ,$v){
		$n = static::$_treeList_baseModel_I++;
		$str = "";
		for($i=0;$i<=$n;$i++){
			$str .= "------";
		}
		$str .= "|";
		if(is_array($arr)){
			foreach($arr as $vo){
				if($vo['pid'] == (string)$v['_id']){
					$vo['title'] = $str.$vo['title'];
					static::$_treeList_baseModel[] = $vo;
					static::_tableTreeHelper($arr, $vo);
				}
			}
		}
	
	}
}