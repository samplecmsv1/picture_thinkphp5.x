<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/admin/content/index/go.html";i:1466109316;s:79:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/admin/base.html";i:1466108654;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php echo widgets('jquery',['level'=>99]); ?>
<?php echo widgets('bootstrap'); ?>
<?php echo widgets('ajax_form'); ?>
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
            <li  target='_blank'><a href="<?php echo url('index/index/index'); ?>">网站首页</a></li>
            <li class="active"><a href="<?php echo url('content/index/go'); ?>">管理</a></li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

     <div class="container" style="padding-top:80px;">

      
        


<?php 
$url = 'content/admin';

$th = [
'sky', 'vine',  'gray', 'industrial', 'social'
];

 ?>


 <div class="page-header">
  <h1 class='hot'>内容</h1>
</div>

<div class="list row">
      <?php  $i=0; foreach($posts as $v){  ?>
      
        <div class="col-sm-6 col-md-2">

          <div class="thumbnail">
          
            
            	<a class='fa fa-plus' href="<?php echo url('content/index/view',['q'=>$v['key']]); ?>">
              
              </a>
              
        
	          <a href="<?php echo url('content/index/index',['q'=>$v['key']]); ?>">
	            <img   data-src="holder.js/150x150?outline=1&text=<?php echo $v['title']; ?>&size=18&theme=<?php echo $th[$i]; ?>" >
	          </a>

          </div>
	 
       
      </div>
      <?php  
      if($i%5==0){
          $i = 0;
      } 
      $i++;
      }
       ?>
      
      
</div>

 

<style>

.list .thumbnail .fa-plus {
    position: absolute;
    top: 10px;
    right: 26px;
    font-size: 27px;
}

</style>
     
<script src="<?php echo base_url(); ?>misc/holder.js"></script>


      

    </div>
  


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModalRemove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">确认删除？</h4>
      </div>
      <div class="modal-body  alert-danger">
         删除数据将不可恢复,请慎重!!!
      </div>
      <div class="modal-footer">
      <a id='myModalRemoveLink' class="btn btn-default" >
           确认删除 
      </a>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
        
      </div>
    </div>
  </div>
</div>





<?php echo widgets(); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>misc/animate.css">

  
  <script type="text/javascript" src="<?php echo base_url; ?>themes/default/home.js"></script>

<script src="<?php echo base_url(); ?>misc/jquery.lazyload.min.js"></script>
<script src="<?php echo base_url(); ?>misc/app.js"></script>

</body>
</html>
