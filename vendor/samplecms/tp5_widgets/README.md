# thinkphp 5.x widgets支持

安装  composer require samplecms/tp5_widgets


事例

模板中调用jquery 

	{:tp\\helpers\\widget::start('jquery',['level'=>99])}



layout中显示

	{:tp\\helpers\\widget::render()}



也可以定义函数来简单的袜


	function widgets($name=null,$par=null){
	    $in = ['js_code','css_code','js','css'];
	    if($name && !in_array($name,$in) ){
	        return tp\helpers\widget::start($name,$par);
	    }
	    return tp\helpers\widget::render();
	}





命名空间 `tp\widgets`


### 如有问题请在微博中 @太极拳那点事儿 http://weibo.com/sunkangchina


