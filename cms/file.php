<?php 
namespace cms;
/**
 *
 *
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2016
 */
use tp\helpers\str;
use tp\helpers\file;
class file{

	function insert($arr = []){
		$ext =  $arr['ext']?:file_ext($local_path);
		$hash = hash('sha256',$arr['data']);
		
		$mime = $arr['mime'];
		$size = $arr['size'];

		$name = 'upload/'.date('Ym').'/'.str::rand(8).".".$ext;
		$file_path = APP_PATH.'/../public/'.$name;
		$dir = file_dir($file_path);
		if(!is_dir($dir)) @mkdir($dir,0777,true);
		 
		$one = (array)db::get('files')->findOne(['hash'=>$hash]);
		 
		if($one['_id']){
			return  $one['path'];
		}
		
		$r = file_put_contents($file_path, $arr['data']);
		if($r){
			$data = array(
					'path'       =>$name,
					'extension'  => $ext,
					'mime'       => $mime,
					'size'       => $size,
					'hash'        => $hash,
			);
				
			 
			db::get('files')->insert($data);
			return $name;
		}
		
	}
	function urls($urls){
		foreach($urls as $u){
			$q[] = self::url($u);
		}
		return $q;
	}
	function url($url){
		$client = new \GuzzleHttp\Client();
		$res = $client->request('GET', $url);
		if(strtolower($res->getStatusCode() !=200)){
			trace('guzzlehttp get failed'.$url,'info');
		}
		$arr['mime'] = $info['content_type'];
		$arr['size'] = $info['download_content_length'];
		$arr['ext'] = file::ext($url);
		$arr['data'] = $res->getBody();
		return self::insert($arr);
	}

}