<?php include_once('template/header.php');?>
<div class="container" style="margin:5%">

<div class="card border-primary mb-3" style="max-width: 100rem;">
  <div class="card-header" style="display:flex">
      <div >
      <?php echo $post->title?>
    </div>
    <div>

</div>
</div>
  <div class="card-body">
  <article class="post vt-post">
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
                    <?php
					if ($post->images){
						$images=unserialize($post->images);
						foreach($images as $image){
					?>
					<div class="row">
					<div class="col-xs-12">

                        <img src="<?php echo base_url(); ?>uploads/<?php echo $image; ?>" class="img-fluid" alt="image post">

                    </div>
                    </div>
					 
					<?php
						}
					}
					?>
                </div>    
               
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-8">
                    <div class="caption">
                        <h3 class="md-heading"><?php echo $post->title?></h3>
                        <p> <?php echo $post->description?> </p>
                        <a class="btn btn-default" href="#" role="button">Read More</a> </div>
					<div class="author-info author-info-2">
                        <ul class="list-inline">
                            <?php if ($author){ ?>
							<li>
                                <div class="info">
                                    <p>Author: <strong><?php echo $author->username ?></strong></p>
									
								</div>
                            </li>
							<?php } ?>
                            <li>
                                <div class="info">
                                    <p>Posted on: <strong><?php echo $post->published_date?></strong></p>
                                    
								</div>
                            </li>
                        </ul>
                    </div>
					<div>
						<input type="button" id="fav_btn" value="Add to Favorites" class="btn btn-primary">
					</div>
                </div>
				
			</div>
        </article>
  </div>
</div>

<div class="card border-primary mb-3" style="max-width: 100rem;">
  <div class="card-header">Comments</div>
  <div class="card-body">
	<table class="table table-bordered">
	  <tbody>
		<?php if($comment_list){
			foreach($comment_list as $comment){
			?>
		<tr>
		  <td><?php if($comment->is_user){ ?><?= $comment->username; ?><?php }else{ ?>Anonymous<i>(<?= $comment->username; ?>)</i><?php } ?></td>
		  <td><?= date("Y-m-d H:i:s",$comment->time); ?></td>
		  <td><?= $comment->comment; ?></td>
		</tr>
		<?php
			}
		}
		?>
	  </tbody>
	</table>
  </div>

  <div class="card-header">Reply</div>
  <div class="card-body">
  <div class="form-group">

        <div class="col-md-16">
        <form id="comment_form">
			<?php echo form_textarea(['name'=>'comment','id'=>'comment','class'=>'form-control']);?>
			<input type="hidden" name="post_id" id="post_id" value="<?= $post->id; ?>">
			<br />
			<input type="button" id="comment_btn" value="Submit" class="btn btn-primary">
		</form>
        </div>
    </div>
  </div>
</div>
<script>
$('#comment_btn').click(function(){
	    var form_data = new FormData($('#comment_form')[0]);
        var comment = $('#comment').val();
			if(comment != ''){
			    $.ajax({
			        type: "POST",
			        url: "<?php echo base_url("user/comment");?>",
			        data: form_data,
			        processData: false,
			        contentType: false,
			        success: function(res) {
			        if(res)
			            {
			                alert(res);
		               		setTimeout(function() {
						    location.reload();
							}, 2010);
			            }
			        }
			    }); 
			}
			else{
				alert('Please enter the comment!');
			}
});
$('#fav_btn').click(function(){
	    var form_data = new FormData($('#comment_form')[0]);
		$.ajax({
			type: "POST",
			url: "<?php echo base_url("user/fav");?>",
			data: form_data,
			processData: false,
			contentType: false,
			success: function(res) {
				if(res){
			                alert(res);
		               		setTimeout(function() {
						    location.reload();
							}, 2010);
			    }
			}
		}); 
			
});
</script>
</div>