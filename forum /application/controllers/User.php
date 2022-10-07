<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->load->helper('form');
      $this->load->library('form_validation');
  
     
    // $this->load->model('login_model');
    }

    public function index()
    {
      $user_id = $this->session->userdata('user_id');
      $personalData = $this->profile_model->chkPersonalInfo($user_id);
      
      $this->load->view('profile', ['personalData' => $personalData]);
      $this->load->view('template/footer');
      }


     /*To load addProfile page*/
    public function addProfile(){
        $this->load->model('profile_model');
        if($this->session->userdata('logged_in')==FALSE){
          redirect('login');
          }
          $this->load->view('template/header');
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



 public function post()
	{
		$this->load->model('post_model');
		$posts=$this->post_model->getPosts();
		$this->load->view('template/header');
		$this->load->view('post',['posts'=>$posts]);
		$this->load->view('template/footer');
	
	}

	public function create_post(){
		$this->load->view('create');
	}

	public function save_post(){
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		
		if ($this->form_validation->run())
                {
                        $data =$this->input->post();

                        $today = date('Y-m-d');
                        $data['published_date']=$today;
						unset($data['submit']);


						// echo '<pre>';
						// print_r($data);
						// echo '</pre>';
						// exit();
						$this->load->model('post_model');
						//images upload
						$uploadData=array();
						if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){
							$filesCount = count($_FILES['files']['name']); 
							for($i = 0; $i < $filesCount; $i++){ 
								$_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
								$_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
								$_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
								$_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
								
								// File upload configuration 
								$uploadPath = 'uploads/'; 
								$config['upload_path'] = $uploadPath; 
								$config['allowed_types'] = 'jpg|jpeg|png|gif'; 
								//$config['max_size']    = '100'; 
								//$config['max_width'] = '1024'; 
								//$config['max_height'] = '768'; 
								 
								// Load and initialize upload library 
								$this->load->library('upload', $config); 
								$this->upload->initialize($config); 
								 
								// Upload file to server 
								if($this->upload->do_upload('file')){ 
									// Uploaded file data 
									$fileData = $this->upload->data();
									
									$image_width=$fileData["image_width"];
									$image_height=$fileData["image_height"];
									$image_path=$fileData["full_path"];
									$width_ratio=$image_width/300;
									$height_ratio=$image_height/300;
									if ($width_ratio>$height_ratio){
										$new_width=intval(300*$height_ratio);
										$new_height=$image_height;
										$x_axis=$image_width-$new_width;
										$y_axis=0;
									}else{
										$new_width=$image_width;
										$new_height=intval(300*$width_ratio);
										$x_axis=0;
										$y_axis=$image_height-$new_height;
									}
									//crop
									
									$gd_config['image_library'] = 'gd2';
									$gd_config['source_image'] = $image_path;
									$gd_config['maintain_ratio'] = false;
									$gd_config['width']     = $new_width;
									$gd_config['height']     = $new_height;
									$gd_config['x_axis']     = $x_axis;
									$gd_config['y_axis']   = $y_axis;
									$this->load->library('image_lib', $gd_config);
									$result=$this->image_lib->crop();

									//resize
									unset($gd_config);
									$gd_config['image_library'] = 'gd2';
									$gd_config['source_image'] = $image_path;
									//$gd_config['create_thumb'] = TRUE;
									$gd_config['maintain_ratio'] = true;
									$gd_config['width']     = 300;
									$gd_config['height']     = 300;
									$this->image_lib->clear();
									$this->image_lib->initialize($gd_config);

									$result=$this->image_lib->resize();
									
									$uploadData[] = $fileData['file_name'];
								}else{  
									$errorUploadType .= $_FILES['file']['name'].' | ';
								} 
							}
						}
						if ($uploadData){
							$data["images"]=serialize($uploadData);
						}
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


    public function view_post($id){
       
        $this ->load->model('post_model');
        $post = $this -> post_model->getSinglePost($id);
		$this->load->model('comment_model');
		$comment_list=$this->comment_model->getComment($id);
		$this->load->model('user_model');
		$author=$this->user_model->getInfoById($post->user_id);
		$this->load->view('view_post',['post'=>$post,'comment_list'=>$comment_list,'author'=>$author]);
	}
	
	public function comment(){
		$username = $this->session->userdata('username');
		$post =$this->input->post();
		$data=array();
		if ($username){
			$data["username"]=$username;
			$data["is_user"]=1;
		}else{
			$data["username"]=$this->input->ip_address();
			$data["is_user"]=0;
		}
		$this ->load->model('comment_model');
		$data["comment"]=$post["comment"];
		$data["post_id"]=$post["post_id"];
		$data["time"]=time();
		$this->comment_model->addComment($data);
		echo "Comment add success";
	}
	public function fav(){
		$user_id = $this->session->userdata('user_id');
		if ($user_id){
			$post =$this->input->post();
			$data=array();
			$data["post_id"]=$post["post_id"];
			$data["date_published"]=date('Y-m-d');
			$data["user_id"]=$user_id;
			$this->load->model('bookmark_model');
			$info=$this->bookmark_model->addFav($data);
			echo $info;
		}else{
			echo "please login!";
		}
	}
	public function fav_list(){
		if($this->session->userdata('logged_in')==FALSE){
          redirect('login');
        }
		$user_id = $this->session->userdata('user_id');
		$this->load->model('bookmark_model');
		$posts=$this->bookmark_model->getFav($user_id);
		$this->load->view('template/header');
		$this->load->view('fav',['posts'=>$posts]);
		$this->load->view('template/footer');
	}
	public function fav_del($id){
		$this->load->model('bookmark_model');
		$posts=$this->bookmark_model->delFav($id);
		redirect('user/fav_list');
	}

	public function searchPosts() {
        $this->load->model('post_model');
        $title = $this->input->post('title');
        $posts = $this->post_model->findPosts($title);
        $output = '<ul style="display:block !important;margin-left:15px;padding:12px;" class="dropdown-menu">';
        if (count($posts) > 0) {
            //var_dump($posts);
            foreach($posts as $post){
                 $output .= '<li  style="cursor:pointer;" value='.$post->title.'>
                             <a href="'.base_url('/user/view_post/').$post->id.'" style="padding:0px;"> 
                                 <tbody>
                                     <tr>
                                         <td style="width:25%;font-weight: bold;color:#686666;font-size:15px;">'.$post->title.'</td>
                                     </tr>                                    
                                 </tbody>
                             </table>
                             </a>
                            </li>';                
             }
             $output .= '</ul>';
             echo $output;
        } else {
            $output .= '<li>Record not found!</li>';
            echo $output;
        }
    }
    
}

  












