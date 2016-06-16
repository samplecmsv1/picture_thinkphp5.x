<?php
namespace cms;
/**
 * @author Sun Kang <68103403@qq.com>
 */
class tree{
	
	/**
    * 无限级分类，显示
    * @$arr 数组 
    * @$id id
    * @$show_curent 是否显示当然分类
    * @$pid 分类上级id
    * @$name 显示名
    */
	static function toTree($arr,$s=0,$selected='',$id='id',$pid='pid',$name='title',$span=1)
	{ 
		if(!is_array($arr)) return;
		$str = "<option value=0>----</option>"; 
		foreach($arr as $rs){ 
			if($rs->$pid == $s){
				unset($select);
				if(is_array($selected)){
					if(in_array($rs->$id , $selected))
						$select = "selected='selected'";	
				}
				elseif($selected == $rs->$id) $select = "selected='selected'";			
				$str .= "<option value='".$rs->$id."' $select >".($rs->$name)."</option>"; 
				$str .= self::toTreeHelper($arr,$selected,$rs->$id,$pid,$id,$name,$span);
			}
		}
		return $str;
	}
	//辅助生成tree
	static function toTreeHelper($arr,$selected,$value,$pid,$id,$name,$span)
	{
		$array = array();
		for($i=0;$i<$span;$i++){
			$string .='&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		foreach($arr as $rs){  
			if($value == $rs->$pid){
				unset($select);
				if(is_array($selected)){
					if(in_array($rs->$id , $selected))
						$select = "selected='selected'";	
				}
				elseif($selected == $rs->$id) $select = "selected='selected'";
				$str .="<option value='".$rs->$id."' $select>".$string.($rs->$name)."</option>";
				if(self::toTreeHelper($arr,$selected,$rs->$id,$pid,$id,$name,$span))
				$str .=self::toTreeHelper($arr,$selected,$rs->$id,$pid,$id,$name,$span+1);
			}
		}
		return $str;
	}
	
	
}
