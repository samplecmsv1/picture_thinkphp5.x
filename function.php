<?php
/**
 * 函数 
 *
 * 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina
 * 2016
 */



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