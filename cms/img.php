<?php
namespace cms;
/**
 *
 *
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2016
 */
use Imagine\Image\Box;
use Imagine\Image\Point;
use tp\helpers\file;

class img{
	static function ori($file){
		return img_url().$file;
	}
	static function thum($file,$w=200,$h=200){
		if(filesize(APP_PATH.'/../public/'.$file) < 1000){
			return img_url().$file;
		}
		if(!is_string($file)){
			return;
		}
		$th = self::set($file,['w'=>$w,'h'=>$h]);
		$thFile =   APP_PATH.'/../public/'.$th;
		if(file_exists($thFile)){
			return img_url().$th;
		}
		$d = file::dir($thFile);
		if(!is_dir($d)){
			mkdir($d,0777,true);
		}
		
		$imagine = new \Imagine\Gd\Imagine();
		$image = @$imagine->open(APP_PATH.'/../public/'.$file);

		$image->resize(new Box($w, $h))
   			 ->save($thFile);
   		 return img_url().$th;
     
	}

	 

	/**
	* 生成缩略图
	*
	*<code>
	*需要配置上面的代码Route::get('imagine'......
	* 
	* set('/upload/201408/53f59883545d3jpeg' , ['w'=>400,'h'=>300])
	*
	* 将生成
	* /thum/201408/53f59883545d3,w_400,h_300.jpeg
	*
	* </code>
	* @param string $path 　 
	* @param string $arr 　 
	* @return  string
	*/
	static function set($path,$arr = []){
		$ext  = substr($path,strrpos($path,'.'));
		$name = substr($path,0,strpos($path,'.')); 
		foreach($arr as $k=>$v){
			$e .=','.$k.'_'.$v;
		}
		$f = $name.$e.$ext;
		if(substr($f,0,1)=='/')
			$f = substr($f,1);
		$f = substr($f,strpos($f,'/'));
		return 'thumb'.$f;
	} 
	
	/**
	* mime 
	*
	* @param string $name 　 
	* @param string $arr 　 
	* @return  string
	*/
	static function mime($name){
		return getimagesize($name)['mime'];
	}
 	 
 	/**
	* 本地的图片,如果存在返回图片的URL 
	*
	* @param string $str 　 
	* @return  string/null
	*/
	static function get_local_one($str){
		return static::local($str , false);
	} 
 	/**
	* 本地的所有图片,如果存在返回图片的URL 
	*
	* @param string $str 　 
	* @return  array/null
	*/
	static function get_local_all($str){
		return static::local($str , true);
	}
 
	/**
	* 不区别本地或线上图片,返回第一个图片的URL 
	*
	* @param string $str 　 
	* @return  string/null
	*/
	static function get_one($str){
		return static::get($str , false);
	}
	 
	/**
	* 不区别本地或线上图片,返回所有图片的URL 
	*
	* @param string $str 　 
	* @return  array/null
	*/
	static function get_all($str){
		return static::get($str , true);
	} 
	/**
	* 移除内容中的图片元素
	*
	* @param string $content 　 
	* @return  string
	*/
	static function remove($content){  
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
		$out = preg_replace($preg,"",$content);
		return $out;
	} 
 
	/**
	* 图片的宽高
	*
	* @param string $img 　 
	* @return  array [w,h]
	*/
	static function wh($img){
		$a = getimagesize($img);
		return array('w'=>$a[0],'h'=>$a[1]);
	}
 	/**
	*  内部函数
	*/
	static function get($content,$all=true){ 
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i'; 
		preg_match_all($preg,$content,$out);
		print_r($out);
		$img = $out[2];  
		if($all === true){
			return $img;
		}else if($all === false){
			return $img[0]; 
		}
		return $out[0];
	} 
	/**
	*  内部函数
	*/
	static function local($content,$all=false){  
		$img = static::get($content, true);
		if($img) { 
			$num = count($img); 
			for($j=0;$j<$num;$j++){ 
				$i = $img[$j]; 
				if( (strpos($i,"http://")!==false || strpos($i,"https://")!==false ))
				{
					unset($img[$j]);
				}
			}
		}
		if($all === true){
			return $img;
		}
		return $img[0]; 
	} 
	

}