<html>
<head>
    <title>Forum</title>
    <script type="text/javascript" src="https://cdn.staticfile.org/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="https://kit.fontawesome.com/bc39957143.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url();?>">Poetry Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url();?>">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url();?>/post">Discussion
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
      </ul>
      
      <form class="d-flex" style="padding-right:100px;">
        
      <div class="search">
               <?php echo form_input(['name'=>'search', 'class'=>'form-control search', 'id' =>'searchPost', 'placeholder'=>'Search Post']); ?>
               <div id="postList"></div>
          </div>
    
        
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <button type="button" class="btn btn-primary" style="margin-left:15px;"><i class="fa-solid fa-user"></i>
        <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="margin-right:100px;">
     
      <?php if(!$this->session->userdata('logged_in')) : ?>
        <button class="btn btn-outline-primary-sm">
          <a class="nav-link" href="<?php echo base_url();?>/login">Login</a>
        </button>
        <?php endif; ?>
          <?php if($this->session->userdata('logged_in')) : ?>
        <button class="btn btn-outline-primary-sm">
          <a class="nav-link" href="<?php echo base_url();?>/login/logout">Logout</a>
        </button>
		<button class="btn btn-outline-primary-sm">
          <a class="nav-link" href="<?php echo base_url();?>/user/fav_list">Favorites</a>
        </button>
        <?php endif; ?> 
        <button class="btn btn-outline-primary-sm">
          <a class="nav-link" href="<?php echo base_url();?>/user/addProfile">Profile</a>
        </button>  
      </div>
      </form>

    </div>
  </div>
</nav>

<script type="text/javascript">

    /*For adding user personal information*/
    
  $('#searchPost').keyup(function(event){
    event.preventDefault();
    
    var data;
    var title = $('#searchPost').val();
    if(title != ''){
    $.ajax({
            url: "<?php echo base_url("user/searchPosts");?>",
            method: "POST",
            data: {title:title},
            success: function(data){
              $('#postList').fadeIn();
              $('#postList').html(data);
            }
        });
      }else{
        $('#postList').fadeOut();
      }
  });
  </script>

