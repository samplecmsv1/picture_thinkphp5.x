<?php
namespace  app\content\controller;

class Index extends Auto {
	public $jump = 'content/index/index';
	public $per_page = 10;
	public $sort = ['created'=>-1];
	public $condition = [];
	public $viewpage = 'index';
	public $data = [];
	public $info = '操作已完成';
	public $disable = false;
	protected function get_dir(){
		$model = "\app\content\models\\";
		$list = scandir(__DIR__.'/../models');
		foreach($list as $v){
			if(!in_array($v,[
				'.','..','./svn'

				])
				&& substr($v,-4) == '.php'
				&& $v != 'Base.php'
			){
				$v =substr($v,0,-4);
				$a  = $model.$v;
				$a = obj($a);
				$b['title'] = $a->title;
				$b['key'] = $v;
				$file[] = $b;
			}

		}
		return $file;
	}
	function init(){
		parent::init();
		$q = ucfirst($_GET['q']);
		if(!$q){
			goto end;
		}
		$model = "\app\content\models\\$q";
		$this->obj = new $model;
		$this->data['fields'] = $this->obj->get_fields();
		$this->data['index'] = 'index/'.$this->obj->get_lists_name();
		$this->data['view'] = $this->viewpage = 'form/'.$this->obj->get_form_name();


		$allowFields = [
				'title','status'
				
		];
		
		$int = [
			'status'
		];
	
		foreach($this->data['fields'] as $k=>$v){
			$allowFields[] = $k;
			 
		}
		/**
		 * 允许保存到数据库的字段
		 * @var array $allowFields
		 */
		$this->obj->allowFields = $allowFields+$this->obj->allowFields;
		 
		$this->jump = url('content/index/'.$this->data['list'],['q'=>$_GET['q']]);
		
		$this->data['type'] = $this->obj->title;
		end:
	}

	function status(){
		if($this->disable === true){
			return;
		}
		if(!$_GET['id']){
			return;
		}
		$one = $this->obj->view();
		$s = $one['status']==1?0:1;
		unset($_GET['status']);
		$condition = ['_id'=>new \MongoId($_GET['id'])];
		unset($this->obj->data['status']);
		$this->obj->update($condition,['status'=>(int)$s]);
		flash('success',$this->info);

		redirect(url($this->jump,$_GET));
	}

	
	function go(){
		$data['posts'] = $this->get_dir();
		return $this->make('go',$data);
	}
	function index() {
		$this->viewpage = $this->data['index'];
		$this->data['par'] = ['s'=>$_GET['s'],'q'=>$_GET['q']];
		$this->data['url'] = 'content/index';
 		return parent::index();
	}
	
	function view(){
		if($this->disable === true){
			return;
		}
		if($_GET['id']){
			$data['data'] = $this->obj->view();
		}
		$data['view'] = true;
		if($_POST && is_ajax()){
			$setData = $_POST;
			unset($setData['id']);
			if($_GET['id']){
				$update = true;
				$condition = ['_id'=>new \MongoId($_GET['id'])];
				$rt = $this->obj->updateValidate($condition,$setData);
			}else{
				$insert = true;
				$rt = $this->obj->insertValidate($setData);
			}

			$data['status'] = 1;
			$data['label'] = '系统未知错误';
			$data['msg'] = '保存数据失败！！！';
			if(is_array($rt) && $rt['errors']){
				$data['msg'] = $rt['errors'];
				$data['error'] = 1;
			}elseif($insert==true){
					$data = [
							'status'=>1,
							'msg'=>'添加成功',
							'label'=>'提示信息',
					];
			}elseif($update == true){
				$data = [
						'status'=>1,
						'msg'=>'更新成功',
						'label'=>'提示信息',
				];
			}
			exit(json_encode($data));
		}
		if($this->data){
			$data = $data + $this->data;
		}
		$this->data = $data;
		$this->data['status'] = [
	    	1=>'启用',
	    	0=>'禁用',
	    ];
		$this->data['par'] = ['s'=>$_GET['s'],'q'=>$_GET['q']];
		$this->data['url'] = 'content/index';
		return $this->make($this->viewpage,$this->data);
	}
	
	 
	
}