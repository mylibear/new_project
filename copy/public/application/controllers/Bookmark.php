<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bookmark extends CI_Controller

{
    public function index()
    {
        $this->load->model('post_model');
        $data["title"] = $this->post_model-> getPosts();
        $this->load->view("bookmark", $data);
    }

}