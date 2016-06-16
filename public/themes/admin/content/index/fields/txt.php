<?php 
$label=$v['label'];
$field=$k;
$data=$data;
?>
<div class="form-group">
    <label ><?php echo $label;?></label>
    <input type="input" class="form-control" id="<?php echo $field;?>"   name='<?php echo $field;?>' value="<?php echo $data[$field];?>" >
</div>

 