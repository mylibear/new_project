<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('register_model');
    }

    public function index()
    {
        $this->load->view('template/header.php');
        $this->load->view('register.php');
        $this->load->view('template/footer.php');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            
            
            $password = sha1($this->input->post('password'));
            $verification_key = md5(rand());
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                 'password' => sha1($this->input->post('password')),
                'verification_key' => $verification_key
            );
            $user_id=$this->register_model->insert_user($data);

            //set up email
            $email = $this->input->post('email');
			$config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'mailhub.eait.uq.edu.au',
                'smtp_port' => 25,
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE ,
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n"
            );
            $this->email->initialize($config);
            $this->email->from('s4579487@student.uq.edu.au', 'T');
            $this->email->to($email);
            $this->email->cc('s4579487@student.uq.edu.au');
            $this->email->subject('Web Information Systems Email Test');
         
          $message = 	"
                      <html>
                      <head>
                          <title>Verification Code</title>
                      </head>
                      <body>
                          <h2>Thank you for Registering.</h2>
                          <p>Please click the link below to activate your account.</p>
                          <h4><a href='".base_url()."register/verify_email/".$verification_key."'>Activate My Account</a></h4>
                      </body>
                      </html>
                      ";

          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('infs7202@gmail.com');
          $this->email->to($this->input->post('email'));
          $this->email->subject('Signup Verification Email');
          $this->email->message($message);
       
          //sending email
          if($this->email->send()){
              $this->session->set_flashdata('message','Activation code sent to email');
          }
          else{
              $this->session->set_flashdata('message', $this->email->print_debugger());

          }
          redirect('register');
            
        }
    }
    public function verify_email()
    {
        if($this->uri->segmen(3))
        {
            $verification_key =$this->uri->segment(3);
            if($this->register_model->verify_email($verification_key))
            {
                $data["message"]='<h1 align="center">Your Email has been verified</h1>';
            }
            else{
                $data['message']='<h1 align="center">Invalid Link</h1>';
            }
            $this->load->view('pages/about',$data);
        }
    }
}

?>