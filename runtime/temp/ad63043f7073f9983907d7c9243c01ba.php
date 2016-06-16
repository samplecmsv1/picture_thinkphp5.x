<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:94:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/default/index/index/index.html";i:1466067349;s:81:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/default/base.html";i:1466066117;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<?php echo widgets('jquery',['level'=>99]); ?>
<?php echo widgets('bootstrap'); ?>

<style>
body {
  padding-top: 50px;
}
.starter-template {
  padding: 40px 15px;
  text-align: center;
}
</style>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TP5.X图片站</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo url('index/index/index'); ?>">首页</a></li>
            <li><a href="<?php echo url('index/index/index',['tag'=>'beautyleg']); ?>">beautyleg</a></li>
            <li><a href="<?php echo url('index/index/index',['tag'=>'美女']); ?>">美女</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

     <div class="container">

      
        
<div class="starter-template">
	我是图片网站系统，当然，免费才是最重要的！
</div>
<?php foreach($datas as $v): ?> 
    <?php echo $vo[_id]; endforeach; ?>


<?php echo $pager; ?>


      

    </div>
  





<?php echo widgets(); ?>
</body>
</html>
