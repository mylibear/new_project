<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bookmark_model extends CI_Model
{
    public function getFav($user_id=0){
        $query = $this->db->get_where('bookmark',array('user_id'=>$user_id));
        if($query->num_rows() > 0){
            return $query->result();
        } 
    }

    public function addFav($data){
        $query = $this->db->get_where('bookmark',array('post_id'=>$data['post_id'],'user_id'=>$data['user_id']));
        if($query->num_rows() > 0){
			return "This favorite already exists";
		}else{
			$query = $this->db->get_where('tb_posts',array('id'=>$data["post_id"]));
			$post=$query->row();
			$data["title"]=$post->title;
			$this->db->insert('bookmark',$data);
			return "add success";
		}
		
    }
	
	public function delFav($id){
		$query = $this->db->where('id',$id);
		$this->db->delete('bookmark');
	}

}