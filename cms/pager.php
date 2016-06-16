<?php
namespace cms;
/**
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2013-2016
 */
class pager{
	/**
	 * 数组分页
	 * @param unknown $url
	 * @param unknown $perSize
	 * @param unknown $arr
	 */
	function arrayPage($url,$per,$arr){
		$current = (int)$_GET['page']?:1;
		foreach($arr as $k=>$v){
			if($v){
				$n[] = $v;
			}
		}
		$num = count($n);
		$k=$i = ($current-1) * $per;
		$j = $i+$per;
		
		for($i;$i<$j;$i++){
			$post[] = $n[$i];
		}
		$data['datas']  = $post;
		$data['page'] = page($url,$num,$per);
		return $data;
	}
	/**
	*
	{{PagerHelper::next($posts->last);}}
	Plugins\Masonry\Init::view(array(
 			'tag'=>'#masonry',
 			'itemSelector'=>'.item',
 			'scroll'=>true,
 		 
 		)); 
 		
	*/
	static function next($count){
		$page = (int)$_GET['page']?:1;
		$next = $page+1;
		if($page<=$count){
			$url = URL::current(); 
			$_GET['page']=$next; 
			$s = "?"; 
			foreach($_GET as $k=>$v)
				$s .=$k.'='.$v.'&';
			$url = $url.substr($s,0,-1); 
			echo "<div   class='pagination' style='display:none;'><a href='".$url."'></a></div>";
		}else{
			throw new Exception('exception');
		}
	}
 
	/**
	$p = \Vendor\Pager::img($posts,1,true,"apple_pagination showimg");
	$posts = $p[0];
	$pager = $p[1];	
	$per 每页显示几条  $img 是否是图片
	*/
	static function img($arr,$per=2,$img=false, $class='apple_pagination'){	 
		$current = (int)$_GET['page']?:1;
		$top = $current_page-1>0?:1;
		$next = $current_page+1;
		$num = count($arr);
		$page =  ceil($num/$per); 
		if($current>=$page)
			$current = $page;
 		$k=$i = ($current-1) * $per; 
	 	$j = $i+$per;
	 	 
	 	if($j>= $num) $j = $num;
	  
		foreach($arr as $k=>$v){
			$n[] = $v;	  
		} 
		for($i;$i<$j;$i++){
			$post[] = $n[$i];
		}
		
	 	$p = "<div class='".$class."'>";
		for($i=1;$i<=$page;$i++){
			unset($cls);
			if($i==$current)
				$cls = "class='current'";
			if($img==true){
				$p .= "<span><a href='?page=".$i."' $cls   data-content=\"<img src='".thumb($n[($i-1)*$per],400,300)."'/>\" >".$i."</a></span>";
			}
			else 
				$p .= "<span><a href='?page=".$i."' $cls >".$i."</a></span>";
		}
		$p .= "</div>";
		return array($post,$p);
	}
	
	/**
    * 跳转分页
    */
    function jump_page($page,$pages){
    	$_inc = 10; //增量 
    	if($pages<5){
    		for($i=1;$i<=$pages; $i++){
    			$new[] = $i;
    		}
    	}else{
    		//前面一段
    		for($i=1;$i<6;$i++){
    			$new[] = $i;
    		}
    		//选中分页一段
    		for($p = $page-5;$p <= $page+5 ; $p++){
    			if($p>0 && $p<=$pages && !in_array($p,$new)){
    				$new[] = $p;
    			} 
    		}   
			if(($p+$_inc) < $pages && ($p+$_inc) <= $pages-5){
	    		//在前后5个分页 按1的步代显示  
    			if(!in_array($p,$new)){
					while($p<$pages){  
						$p+=$_inc;
						$new[] = $p;
						$_inc*=2;
					} 
    			} 
	    	}  
	    	//结尾的一段 
    		for($i = $pages-5;$i<=$pages;$i++){
    			if(!in_array($i,$new) && $i>0){
    				$new[] = $i;
    			}
    		} 
    	} 
    	return $new;
    }
}
