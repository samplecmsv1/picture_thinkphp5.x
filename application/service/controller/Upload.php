<?php
namespace app\service\controller;
use tp\helpers\str;
use cms\db;
use Dflydev\ApacheMimeTypes\PhpRepository;
class Upload{
	
	public $table;
	public $upload_dir = "upload";
	public $allowMime = ['image/jpg','image/png','image/gif','image/jpeg'];
	public $obj;
	public $mime;
	function __construct(){
		$this->mime = new PhpRepository;
	}
	
	function hash(){
		$gid = cookie('guest');
		$fs = json_decode($_POST['files']);
		$i = 0;
		foreach($fs as $f){
			$gid = $gid.$f->fileId;
			$hash = $f->fileHash;
			$one = db::get('files')->findOne(['hash'=>$hash]);
			if($one){
				$flag = true;
			}else{
				$flag =  false;
			}
			$data[$i]['id'] = $f->fileId;
			$data[$i]['onserver'] = $flag;
			$data[$i]['hash'] = $hash;
			$i++;
		}
	
		return json($data,200);
	}
	function index(){
		$hash = $_POST['hash'];
		$chunk = $_POST['chunk'];
		$chunks = $_POST['chunks'];
		$ret['fileNameReturn'] = $n = $_POST['fileNameReturn'];
			
		if(!in_array($mime,$this->allowMime)){
	
		}
			
		if($hash){
			$one = (array)db::get('files')->findOne(['hash'=>$hash]);
			if($one){
				unset($one['_id'],$one['uid'],$one['time']);
				$one['name'] = base_url().$one['path'];
				return json($one+$ret,200);
					
			}
		}
		$mime = $_FILES['file']['type'];
		$size = $_FILES['file']['size'];
		if(!$mime){
			return json(['upload'=>false],200);
		}
		$mr = $this->mime->findExtensions($mime);
		$ext = $mr[1]?:$mr[0];
		///
		$dir = $this->upload_dir.'/'.date('Ym');
		
		if(!is_dir(APP_PATH.'/../public/'.$dir)) mkdir(APP_PATH.'/../public/'.$dir,0777,true);
		/////////
		$name = $dir.'/'.str::rand(8).".".$ext;
		
		$filePath = APP_PATH.'/../public/'.$name;
		
		if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
			$contentType = $_SERVER["HTTP_CONTENT_TYPE"];
				
			if (isset($_SERVER["CONTENT_TYPE"]))
				$contentType = $_SERVER["CONTENT_TYPE"];
					
				// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
				if (strpos($contentType, "multipart") !== false) {
					if (isset($_FILES['file']['tmp_name'])  && is_uploaded_file($_FILES['file']['tmp_name'])) {
						// Open temp file
						$out = fopen($filePath, $chunk == 0 ? "wb" : "ab");
						if ($out) {
							// Read binary input stream and append it to temp file
							$in = fopen($_FILES['file']['tmp_name'], "rb");
							if ($in) {
								while ($buff = fread($in, 4096))
									fwrite($out, $buff);
							} else{
							}
							fclose($in);
							fclose($out);
							@unlink($_FILES['file']['tmp_name']);
						}
					}
				}else {
					$out = fopen($filePath, $chunk == 0 ? "wb" : "ab");
					if ($out) {
						$in = fopen("php://input", "rb");
						if ($in) {
							while ($buff = fread($in, 4096))
								fwrite($out, $buff);
						} else{
						}
						fclose($in);
						fclose($out);
					}
				}
				 
				if(($chunk && ($_POST['chunk']+1) != $_POST['chunks'])){
					return json(['error'=>1,'msg'=>'分块上传进行中'],200);
				}
				$data = array(
						'path'       =>$name,
						'extension'  => $ext,
						'mime'       => $mime,
						'size'       => $size,
						'hash'        => $hash,
				);
					
				$uid = cookie('id');
				if($uid){
					$data['uid'] = $uid;
				}
				 
				$nid = db::get('files')->insert($data);
					
				if(!$hash){
					db::get('files')->update(['_id'=>$nid],['hash'=>$h1]);
					$data['hash'] = $h1;
				}
				$data['name'] = base_url().$data['path'];
				
				return json($data+$ret , 200);
	}
	
	
	
}