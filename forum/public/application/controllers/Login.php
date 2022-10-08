<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');

		if (!$this->session->userdata('logged_in'))
		{	
			if (get_cookie('remember')) { 
				$username = get_cookie('username'); 
				$password = get_cookie('password'); 
				$user=$this->user_model->login($username, $password) ;
				
				if ($user){
					
					$user_data = array(
						'username' => $username,
						'logged_in' => true,
						'user_id'=>$user->user_id
					);
					$this->session->set_userdata($user_data); 
					$this->load->view('profile'); 
				}
			}else{
				$this->load->view('login', $data);	
			}
		}else{
			$this->load->view('profile');
		}
		$this->load->view('template/footer');


	
	}

	public function check_login()
	{
		$this->load->model('login_model');		
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); 
		$password = sha1($this->input->post('password')); 
	
		$result=$this->login_model->login($username,$password);
	    
		if($this->session->userdata('logged_in')==FALSE){
			if ( $this->login_model->login($username, $password) )
				{
					$user=$this->login_model->login($username, $password) ;
					$user_data = array(
						'username' => $result->username,
						'email'=>$result->email,
						'logged_in' => true,
						'user_id'=>$user->user_id						
					);
					$this->session->set_userdata($user_data); 
					// $data['username'] = $this->session->userdata('username');
					// $data['email'] = $this->session->userdata('email');
					
					redirect('profile'); 
				}else
				{
					$this->load->view('login', $data);	
					$this->db->close();
				}
		}else{
			redirect('profile');

		}	
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_id');
		redirect('login'); 
	}
}
?>

