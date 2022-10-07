<?php include_once('template/header.php');?>
<body>
<div class="container">
<table class="table ">
    <thead>
        <tr>
        <th scope="col">Title</th>
        
        <th scope="col">Publish Date</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
   
         
            <tr>
            <td> title</td>
            
            <td>publish </td>
            <td>
                <?php echo anchor("user/view_post/", 'View', ['class'=> 'btn btn-primary btn-sm']);?>
                
            </td>
            </tr>
      
            <tr>
                <td>No records found</td>
            </tr>   
  
        
        
    </tbody>
    </table>
 
</div>