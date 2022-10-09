<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->model('post_model');
		$posts=$this->post_model->getPosts();
        if(null===$posts){
            $posts = [];
        }
		$this->load->view('template/header');
		$this->load->view('post',['posts'=>$posts]);
		$this->load->view('template/footer');
	
	}

	public function create(){
		
		if($this->session->userdata('logged_in')==FALSE){
          redirect('login');
        }
		$user_id = $this->session->userdata('user_id');
		$data=array();
		$data["user_id"]=$user_id;
		$this->load->view('create',$data);
		
		
	}

	public function save(){
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		
		if ($this->form_validation->run())
                {
                        $data =$this->input->post();
						unset($data['submit']);
						// echo '<pre>';
						// print_r($data);
						// echo '</pre>';
						// exit();
						$this->load->model('post_model');
						if($this->post_model->addPost($data)){
							$this->session->set_flashdata('msg','Post saved');
						}else{
							$this->session->set_flashdata('msg','Post save failed');
						}
						redirect('post');
                }
                else
                {
					$this->load->view('create');
                }
		
	}
}
