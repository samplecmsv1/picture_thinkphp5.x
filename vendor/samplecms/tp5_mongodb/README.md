# thinkphp 5.x mongodb支持

安装  composer require samplecms/tp5_mongodb

代码片段

连接数据库 
	
	function db_connect($config){
		mongo::$server = "mongodb://".$config['host'];
		mongo::$options = array('db'=>$config['db']);
		return new \tp\mongo\db(); //想法静态吧。演示就不写了。
	}
	

分页

	function pager($tb,$par = []){
		$url = $par['url']?:'/posts';
		$size = $par['size']?:10;
		$condition = $par['condition']?:[];
		unset($par['url'],$par['size'],$par['condition']);

		$count = modb($tb)
		->count($condition);

		$pageArray =  \tp\helpers\paginate($url,$count,$size);
		$data['pager'] = $pageArray['link'];
		$mo = modb($tb)
		->find($condition);

		if($par){
			foreach ($par as $k=>$v){
				$mo = $mo->$k($v);
			}
		}
		$mo = $mo->skip($pageArray['offset']);
		$mo = $mo->limit($size);
		$data['datas'] = $mo;
		$data['count'] = $count;
		return $data;
	}


其中 modb方法实际上是没有的。就是mongodb连接的对象



命名空间 tp\mongo

如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina








