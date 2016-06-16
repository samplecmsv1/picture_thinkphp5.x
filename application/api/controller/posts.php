<?php
namespace app\api\controller;
use think\controller\Rest;
class Posts extends Rest
{
	public function read_get_xml()
    {
        // 输出id为1的Info的XML数据
    }


    public function read_json()
    {
        $data = ['test'=>'1'];
    	return json($data, 200);
    	
    	 
    }
}
