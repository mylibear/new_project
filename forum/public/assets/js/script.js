$(document).ready(function(){
  /*For adding user personal information*/
  $('#personal_form').submit(function(event){
    event.preventDefault();
    var username = $('#username').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var aboutme = $('#aboutme').val();
    var usr_userfile = $('usr_userfile').val();
  
    if(username != '' && first_name != '' && last_name != '' && email != '' && aboutme != '' && usr_userfile!= ''){			
      $.ajax({
                
                url: "<?= base_url(profile/addUserPersonalInfo');?>", 
                type:"POST",
                data:new FormData(this),
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
    }
    else{
      alert('All fields are required!');
    }
});

});
