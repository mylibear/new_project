<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post_model extends CI_Model
{
    public function getPosts(){
        $query = $this->db->get('tb_posts');
        if($query->num_rows() > 0){
            return $query->result();
        } 
    }

    public function addPost($data){
        return $this->db->insert('tb_posts',$data);
        
    }

    public function getSinglePost($id){
        $query = $this->db->get_where('tb_posts',array('id'=>$id));
        if($query->num_rows() > 0){
            return $query->row();
        } 
    }


    public function findPosts($title){
        $this->db->like('tb_posts.title', $title);
        $posts = $this->db->get('tb_posts');
        return $posts->result();
  }

}