<?php include_once('template/header.php');?>

<div class="card border-primary mb-3" style="max-width: 80rem ;margin:2%">

  <div class="card-header">Header</div>
  <div class="card-body">
  <?php echo form_open_multipart('user/save_post',['class=>form-horizontal']);?>
  <fieldset >
    <legend></legend>
    <div class="form-group" style="max-width: 80rem ;margin:2%">
      <label for="inputEmail" class="col-md-5 control-label"></label>
      <div class="col-md-15">
        <?php echo form_input(['name'=>'title','placeholder'=>'Title','class'=>'form-control']);?>
		<!-- <input type="hidden" name="user_id" value="<?= $user_id; ?>"> -->
      </div>
    </div>
    <div class="col-md-5">
        <?php echo form_error('title','<div class="text-danger">','</div>');?>
     </div>

     <div class="form-group" style="max-width: 80rem ;margin:2%">
     <label for="textArea" class="col-md-15 control-label"></label>
        <div class="col-md-16">
    
        <?php echo form_textarea(['name'=>'description','placeholder'=>'Description','class'=>'form-control']);?>
        </div>
    </div> 
    <div class="col-md-5">
    <?php echo form_error('title','<div class="text-danger">','</div>');?>
    </div>
   <div>
   
   <div class="form-group" style="max-width: 80rem ;margin:2%">
     <label for="textArea" class="col-md-15 control-label"></label>
        <div class="col-md-16">
        <input type='file' name='files[]' multiple class="form-control" />
        </div>
    </div> 
    
   <div>
   
   <div class="form-group" style="max-width: 80rem ;margin:2%">
        <div class="col-md-10 col-md-offset-2">
        <?php echo form_submit(['name'=>'submit', 'value'=>'Submit','class'=> 'btn btn-primary']);?>

        <?php echo anchor('post', 'Back', ['class'=> 'btn btn-primary']);?>
        </div>
    </div>    
  </fieldset>
  <?php echo form_close();?>
   
  </div>
</div>

