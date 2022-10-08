<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comment_model extends CI_Model
{
    public function getComment($post_id=0){
        $query = $this->db->get_where('comments',array('post_id'=>$post_id));
        if($query->num_rows() > 0){
            return $query->result();
        } 
    }

    public function addComment($data){
        return $this->db->insert('comments',$data);
    }

}