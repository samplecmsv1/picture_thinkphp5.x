<?php 
$label=$v['label'];
$field=$k;
$data=$data;
?>
<div class="form-group">
	    <label><?php echo $label;?></label>
	  	<?php 
	  	widgets('jui');
	  	widgets('plupload',[
	  			'ele'=>'file',
	  			'option'=>[
		  			//'CKEDITOR'=>$field,
					'maxSize'=>50,
	  				'class'=>'upload',
	  				'count'=>50,
	  				'data'=>$data[$field],
		  		]			
		]);
	  	?>
</div>