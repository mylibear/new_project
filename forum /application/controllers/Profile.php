<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller{
    public function __construct(){
      parent::__construct();
  
      $this->load->model('profile_model');
      if($this->session->userdata('logged_in')==FALSE){
        redirect('login');
        }
    // $this->load->model('login_model');
    }

    public function index()
    {
      $user_id = $this->session->userdata('user_id');
      $personalData = $this->profile_model->chkPersonalInfo($user_id);
      $this->load->view('template/header');
      $this->load->view('profile', ['personalData' => $personalData]);
      $this->load->view('template/footer');
      }


     /*To load addProfile page*/
    public function addProfile(){
      $user_id = $this->session->userdata('user_id');
      //$profileData = $this->profile_model->getProfileData($user_id);
      /*To check if personal information is saved or not*/
      $personalData = $this->profile_model->chkPersonalInfo($user_id);
      /*To check if qualification information is saved or not*/
     
      $this->load->view('profile', ['personalData' => $personalData,]);
  } 

      /*To add user personal details*/
    public function addUserPersonalInfo(){
        
      $username = $this->input->post('username');
      $first_name = $this->input->post('first_name');
      $last_name = $this->input->post('last_name');
      $email = $this->input->post('email');
      $aboutme = $this->input->post('aboutme');
    
      $user_id = $this->session->userdata('user_id');

      $config['upload_path'] = 'uploads/';
      $config['allowed_types'] = '*';      
      $config['max_size'] = 1024000;
      $config['max_width'] = 10240;
      $config['max_height'] = 7680;
	  

      $image = $_FILES['userfile']['name'];
      $file = explode('.', $image);
      $filename = $file['0'];
      $extension = $file['1'];
      //gives 2.jpg
      $filename = $user_id.'.'.$file['1'];

      $config['file_name'] = $filename;
     
      $personalData = array(
       
          'first_name' => $first_name,
          'last_name' => $last_name,
			'user_id'=>$user_id,
          'aboutme' => $aboutme,
          'userfile' => base_url().'uploads/'.$filename,
      ); 
      $data = $this->profile_model->addPersonalData($personalData);
      $this->load->library('upload', $config);
      if($this->upload->do_upload('userfile')){
          var_dump( $this->upload->data());
		  $data = $this->profile_model->addPersonalData($personalData);
          echo json_encode($data);            
      }
      else{
          var_dump($this->upload->display_errors());
		  echo "Not Saved";
      }
  }
  /*To update user presonal details*/
  public function editUserPersonalInfo(){
    $username = $this->input->post('username');
      $first_name = $this->input->post('first_name');
      $last_name = $this->input->post('last_name');
      $email = $this->input->post('email');
      $aboutme = $this->input->post('aboutme');
    
      $user_id = $this->session->userdata('user_id');

      $config['upload_path'] = 'uploads/';
      $config['allowed_types'] = '*';      
      $config['max_size'] = 1024000;
      $config['max_width'] = 10240;
      $config['max_height'] = 7680;
	  

      $image = $_FILES['userfile']['name'];
      $file = explode('.', $image);
      $filename = $file['0'];
      $extension = $file['1'];
      //gives 2.jpg
      $filename = $user_id.'.'.$file['1'];

      $config['file_name'] = $filename;
    

     if($row = $this->profile_model->chkPersonalInfo($user_id)){
         $userfile = $row->userfile;
         $link = explode('/', $userfile);
         $imgFile = $link['5'];
         $personalData = array(
          'first_name' => $first_name,
          'last_name' => $last_name,
			'user_id'=>$user_id,
          'aboutme' => $aboutme,
          'userfile' => base_url().'uploads/'.$filename,
         );
         
         $this->load->library('upload', $config);          
         unlink("uploads/".$filename);
         if($this->upload->do_upload("userfile")){

             $data = $this->profile_model->editPersonalData($personalData, $user_id);          
             echo json_encode($data);
         }                    
     }     
     else{
         if($this->upload->do_upload("userfile")){
             $data = $this->profile_model->editPersonalData($personalData, $user_id);          
             echo json_encode($data);
         }
     }
     
    
 }
  

}










