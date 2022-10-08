<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register_model extends CI_Model
{
  
    public function insert_user($data)
    {
        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }

    public function verify_email($key)
    {
        $this->db->where('verification_key',$key);
        $this->db('is_email_verified','no');
        $query = $this->db->get('users');
        if($query->num_rows>0)
        {
            $data = array(
                "is_email_verified" => 'yes'
            );
            $this->db->where('verification_key',$key);
            $this->db->update('users',$data);

        }
        else
        {
            return false;
        }
    }
}

?>