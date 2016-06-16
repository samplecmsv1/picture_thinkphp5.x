<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:95:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/default/index/index/upload.html";i:1466086042;s:81:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/default/base.html";i:1466086342;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<?php echo widgets('jquery',['level'=>99]); ?>
<?php echo widgets('bootstrap'); ?>
<?php echo widgets('font_awesome'); ?>


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
	上传文件
</div>

<form class='ajax' method='post'>


<?php echo widgets('plupload',[
	'ele'=>'file',
	'option'=>[
		'url'=>url('service/upload/index')
	]
]); ?>
<br style="clear:both;">
<textarea rows="" cols="" name='txt' id='txt'></textarea>
<?php echo widgets('redactor',['ele'=>'#txt']); ?>

</form>





      

    </div>
  





<?php echo widgets(); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/default/css.css">
<script src="<?php echo base_url(); ?>misc/app.js"></script>

</body>
</html>
