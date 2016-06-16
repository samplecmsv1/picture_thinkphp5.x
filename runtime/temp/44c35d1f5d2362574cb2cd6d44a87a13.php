<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:100:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/admin/content/index/index/index.html";i:1466109438;s:79:"/Library/WebServer/Documents/www/app/wstaichi.com/public/themes/admin/base.html";i:1466108654;}*/ ?>
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

      
        
 

<a href=" <?php echo url($url.'/index',$par); ?>" class='fa fa-list' > </a>

<small> <a  class='fa fa-plus' href="<?php echo url($url.'/view',$par); ?>">  </a></small>


<span class="label label-default">
<?php echo $type; ?>
</span>

 
     
     
     <table class="table table-bordered">
       
      <thead>
        <tr>
          <th>标题(<?php echo $count; ?>)</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($datas as $data): ?> 
        <tr>
          <th scope="row"><?php echo strip_tags($data['title']); ?></th>
          <td><?php echo date('Y-m-d H',$data['created']->sec); ?></td>
          <td >
          
          	<a href="<?php echo url($url.'/status',['id'=>(string)$data['_id']]+$par); ?>" class="button">
	         	<?php 
	         		switch ($data['status']){
	         			case 1:
	         				echo '<span class="glyphicon glyphicon-ok"></span>';
	         				break;
	         			default:
	         				echo '<span class="glyphicon glyphicon-remove" style="color:red;"></span>';
	         				break;
	         		}
	         	 ?>
	        </a>
	        
	        
          	<a href="<?php echo url($url.'/view',['id'=>(string)$data['_id']]+$par);; ?>" class="fa fa-pencil">
	          
	        </a>
	        
	        <a href="<?php echo url($url.'/remove',['id'=>(string)$data['_id']]+$par); ?>" class="remove fa fa-remove">
	          
	        </a>
	        
	        
          </td>
        </tr>
       <?php endforeach; ?>
      </tbody>
    </table>
    
    
<?php echo $page; ?>


      

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
