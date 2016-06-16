<?php
namespace cms;
use think\Config;
/**
 * composer require samplecms/tp5_mongodb
 * $r = db::pager('user',['url'=>'index/index/index','size'=>1]);
 * $r = db::get('user')->insert(['s'=>1]);
 *
 * mongodb 操作
 *
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2016
 */
class db{
	 
	protected static $instance;

	protected static  function connect($db = 'db'){

		if(!self::$instance[$db]){
			$config = Config::get('database.'.$db);
		    \tp\mongo\db::$server = "mongodb://".$config['host'];
		    \tp\mongo\db::$options = array('db'=>$config['db']);
		    self::$instance[$db] = new \tp\mongo\db(); 
		}
	    return self::$instance[$db];
	}

	static function get($collection,$db = 'db'){
		return self::connect($db)->collection($collection);
	}


	static function pager($tb,$par = []){
	    $url = $par['url']?:'/posts';
	    $size = $par['size']?:10;
	    $condition = $par['condition']?:[];
	    unset($par['url'],$par['size'],$par['condition']);

	    $count = self::get($tb)
	    	->count($condition);

	    $pages =  new \tp\helpers\paginate($count,$size);
	    $pages->url = $url;
	    $data['pager'] = $pages->show();
	    $mo = self::get($tb)
	   		 ->find($condition);

	    if($par){
	        foreach ($par as $k=>$v){
	            $mo = $mo->$k($v);
	        }
	    }
	    $mo = $mo->skip($pages->offset);
	    $mo = $mo->limit($size);
	    $data['datas'] = $mo;
	    $data['count'] = $count;
	    return $data;
	}


}
