
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>
    </nav>
    <hr class="mt-0 mb-4">

  
                     
    <div class="row">

        <?php if(!isset($personalData)):?>
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile " src="assets/images/avatar.png" style="width:200px;height:200px;border-radius: 50%" alt="Profile image">
                        <h4 style="text-align: center;"><?php echo $this->session->userdata('username');?></h4>     
                    </div>
                </div>
            </div>

        <?php else:?>
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img  class="img-account-profile " src=<?php echo $personalData->userfile;?> style="width:200px;height:200px;border-radius: 50%"  alt="Profile image">
                        <h4 style="text-align: center;"><?php echo $this->session->userdata('username');?></h4>     
                    </div>
                </div>
            </div>

        <?php endif;?>  



        <div class="col-xl-8">
            <!-- Account details card-->
            <div id="personal" class="card mb-4">
                 <div class="alert alert-dismissible alert-success" id="personalMsg" style="display:none">
		    </div>
            <div class="card-header">Account Details</div>
                <form id="personal_form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <!-- <div class="card-body text-center"> -->
               
                <?php echo validation_errors("<div class='alert alert-danger'>","</div>"); ?>
              
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="control-label">Username </label>
                            <input class="form-control" name="username" id=" username" type="text" placeholder="Enter your username" value="<?=$this->session->userdata('username')?>">   
                        </div>
        
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="control-label">First name</label>
                                <?php echo form_input(['name'=>'first_name', 'class'=>'form-control', 'id'=>'first_name', 'value' => isset($personalData) ? set_value('first_name', $personalData->first_name) : '']); ?>
                                <!-- <input class="form-control" name="fname" type="text"  value=""> -->
                            </div>
   
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="control-label">Last name</label>
                                <?php echo form_input(['name'=>'last_name', 'class'=>'form-control', 'id'=>'last_name', 'value' => isset($personalData) ? set_value('last_name', $personalData->last_name) : '']); ?>
                                <!-- <input class="form-control" name="lname"  type="text"  value=""> -->
                            </div>
                        </div>
                        
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="control-label">Email address</label>
                            <input class="form-control" name="email" id=" email" type="text" placeholder="" value="<?=$this->session->userdata('email')?>"> 
                        </div>
                        <div class="mb-3">
                            <label class="control-label">About me</label>
                            <?php echo form_input(['name'=>'aboutme', 'class'=>'form-control', 'id'=>'aboutme', 'value' => isset($personalData) ? set_value('aboutme', $personalData->aboutme) : '']); ?>
                            <!-- <input class="form-control" name="about" type="text" value=""> -->
                        </div>

                     <!-- Profile picture image-->
                    <div class="col-md-6">
                    <?php if(isset($personalData)):?>
						<img src=<?php echo $personalData->userfile;?> style="width:100px;height:100px;border-radius: 50%"  alt="Profile image">
					<?php endif;?>
					<br>
					<label class="control-label" style="margin-top:6px;padding: 10px;">Profile Image</label>
					<?php echo form_upload(['name'=>'userfile', 'id'=>'userfile', 'class'=>'form-control']); ?>  
                    </div>
                    <div class="col-md-6">
                                            
                    </div>
                    </div>
                                       
                        <!-- Save changes button-->
                    <div style="margin:20px">
                    <!-- <?php if(isset($personalData)):?>
                        <input type="button" id="personalSubmit" value="Submit" disabled="true" class="btn btn-success"/>
                        <?php else:?>
                        <input type="button" id="personalSubmit" value="Submit" class="btn btn-success"/>
                        <?php endif;?> -->

                        <?php if(isset($personalData)):?>
						  	<input type="submit" id="personalSubmit" value="Submit" disabled="true" class="btn btn-success"/>
						  	<button type="button" id="btn_update" class="btn btn-primary">Update</button>
						  <?php else:?>
						  	<input type="submit" id="personalSubmit" value="Submit" class="btn btn-success"/>
						  	<button type="button" id="btn_update" class="btn btn-primary" disabled="false">Update</button>
						  	
						  <?php endif;?>
                    </div>


                    
                </form>
            
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

  $('#personalSubmit').click(function(){
	var username = $('#username').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var aboutme = $('#aboutme').val();
    var userfile = $('#userfile').val();
  
    if(username != '' && first_name != '' && last_name != '' && email != '' && aboutme != '' && userfile != ''){			
      $.ajax({
                url:'<?php echo base_url();?>/profile/addUserPersonalInfo',
                type:"POST",
                data:new FormData($('#personal_form')[0]),
                processData:false,
                contentType:false,
                success: function(data){
                  //alert(data);
                  $("#personalMsg").show();
          $("#personalMsg").html('Data saved successfully.');
                  setTimeout(function() { $("#personalMsg").hide(); }, 2000);
                  setTimeout(function() {
            location.reload();
          }, 2010);
                }
            });
    }else{
      alert('All fields are required!');
    }
});



    /*For updating user personal information*/
	$("#btn_update").click(function(event) {
	    event.preventDefault();
	    var form_data = new FormData($('#personal_form')[0]);
        var username = $('#username').val();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var aboutme = $('#aboutme').val();
        var userfile = $('#userfile').val();
			
			if(username != '' && first_name != '' && last_name != '' && email != '' && aboutme != '' && userfile != ''){
			    $.ajax({
			        type: "POST",
			        url: "<?php echo base_url("profile/editUserPersonalInfo");?>",
			        data: form_data,
			        processData: false,
			        contentType: false,
			        success: function(res) {
			        if(res)
			            {
			                $("#personalMsg").show();
							$("#personalMsg").html('Data updated successfully.');
		               		setTimeout(function() { $("#personalMsg").hide(); }, 2000);
		               		setTimeout(function() {
						    location.reload();
							}, 2010);
							//alert(res);
			            }
			        }
			    }); 
			}
			else{
				alert('Please fill all the details!');
			}
	});

</script>
</body>
</html>

