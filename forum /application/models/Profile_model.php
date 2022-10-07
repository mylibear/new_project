<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model
{
    public function getInfo(){
        $query = $this->db->get('users');
        if($query->num_rows() > 0){
            return $query->result();
        } 
    }

	/*To insert user profile data*/
	public function profileInfo($data){
	
			return $this->db->insert('tbl_profile', $data);
		//}
	}


    public function addPersonalData($personalData){
		return $this->db->insert('profile', $personalData);
	}

    public function chkPersonalInfo($user_id){

		$this->db->select(['users.user_id','users.username','profile.first_name','profile.last_name', 'profile.aboutme',  'profile.userfile']);
		$this->db->from('profile');	
		$this->db->join('users', 'users.user_id = profile.user_id');	
		$this->db->where(['users.user_id' => $user_id]);	
		$getProfile = $this->db->get();
		return $getProfile->row();
	}


	public function editPersonalData($personalData, $user_id){
		return $this->db->where('user_id', $user_id)
					->update('profile', $personalData);
	}


}