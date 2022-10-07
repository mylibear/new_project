
    <div class="container" style="margin-top:5%;">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header">
					<?php echo form_open(base_url().'login/check_login'); ?>	
                     <h4 class="mb-5 text-secondary">Login</h4>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
									<input type="text" class="form-control" placeholder="Username" required="required" name="username">
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
									<input type="password" class="form-control" placeholder="Password" required="required" name="password"> 
                                       
                                    </div>
                                </div>
								<div class="col-md-12">
                                <div class="form-group">
								<?php echo $error; ?>
								</div>
								</div>
                            
                                <div class="col-md-12">
									<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Log in</button>
									</div>
                                </div>
                            </div>
							  
                        </form>
						<div class="clearfix">
							<label class="form-check-label"><input type="checkbox" name="remember"> Remember me</label>
							<a href="#" class="float-right">Forgot Password?</a>
							</div> 
                        <p class="text-center mt-3 text-secondary">If you dob't have account, Please <a href="<?php echo base_url('register');?>">Register Now</a></p>
                    </div>
					<?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

