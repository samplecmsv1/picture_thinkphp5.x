<?php
namespace app\index\controller;
use cms\base as Base;
use cms\db;
class Index extends Base
{
	public $theme = 'default';
    public function index($tag = null)
    {
        $data = db::pager('files',[
        			'url'=>'index/index/index',
        			'size'=>50,
        			'sort'=>[
        				'_id'=>-1	
        			]
        			
        		]
        );
        $data['title'] = "美女那点图";
       
       return  $this->make('index',$data);
    }
    
    
    function upload(){
    	
    	
    	return $this->make('upload');
    }
    
}
