<?php
/**
 * 函数 
 *
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2016
 */
function theme_path($a){
	$request = think\Request::instance();
	$module  = $request->module();
	$id = $request->controller();
	return   config('template.view_path').$module.DS.$id.DS.$a.'.php';
}


function obj($class){
	static $m;
	if(!$m[$class]){
		$m[$class] = new $class;
	}
	return $m[$class];
}
 
function is_post(){
	return $_SERVER['REQUEST_METHOD']=='POST'?true:false;
}

function is_ajax(){
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		return true;
	}
	else
	{
		return false;
	}
}


function img_url(){
	if(in_array(ip(),['127.0.0.1','::1'])){
		return base_url();
	}
	return 'http://img.mm.wstaichi.com/';
}



function base_url(){
	$request = think\Request::instance();
	return $request->root().DS;
}



function widgets($name=null,$par=null){
    $in = ['js_code','css_code','js','css'];
    if($name && !in_array($name,$in) ){
        return tp\helpers\widget::start($name,$par);
    }
    return tp\helpers\widget::render();
}







///////////////////////////////////////
// 过滤MONGODB ARRAY中的KEY为$的 $_GET POST COOKIE REQUEST
///////////////////////////////////////
function clean_mongo_array_injection(){
	$in = array(& $_GET, & $_POST, & $_COOKIE, & $_REQUEST);
	while (list ($k, $v) = each($in))
	{
		if(is_array($v)){
			foreach ($v as $key => $val)
			{
				if(strpos($key,'$')!==false){
					unset($in[$k][$key]);
					$key = str_replace('$','',$key);
				}
				$in[$k][$key] = $val;
				$in[] = & $in[$k][$key];
			}
		}
	}
}
clean_mongo_array_injection();




/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function ip($type = 0)
{
	$type      = $type ? 1 : 0;
	static $ip = null;
	if (null !== $ip) {
		return $ip[$type];
	}
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos = array_search('unknown', $arr);
		if (false !== $pos) {
			unset($arr[$pos]);
		}
		$ip = trim($arr[0]);
	} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	// IP地址合法验证
	$long = sprintf("%u", ip2long($ip));
	$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
	return $ip[$type];
}