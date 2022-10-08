<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <?php
                if($this->session->flashdata('message'))
                {
                    echo'
                    <div class="alert alert-sucess">
                        '.$this->session->flashdata('message').'
                    </div>
                    ';
                }
                ?>

                <div class="card shadow">
                    <div class="card-header">
                     <h4 class="mb-5 text-secondary">Create Your Account</h4>
                    </div>
                    <div class="card-body">
                    <?php echo validation_errors("<div class='alert alert-danger'>","</div>"); ?>
                        <form action="<?php echo base_url('register') ?>" method="POST" > 
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>User Name <span class="text-danger">*</span></label>
                                        <input type="text" name="username" value="<?php echo set_value('user_name'); ?>" class="form-control">
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email"  value="<?php echo set_value('email'); ?>"  class="form-control">
                                       
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control">
            
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <div class="form-group">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="cpassword" class="form-control">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-5">Sign Up</button>
                                </div>

                                    
                            </div>
                        </form>
                        <p class="text-center mt-3 text-secondary">If you have account, Please <a href="<?php echo base_url('login');?>">Login Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


