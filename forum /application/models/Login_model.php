<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Login_model extends CI_Model{
     public function construct(){
         parent:: __construct();
     }

    // Log in
    public function login($username,$password){
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('users');

       
        if($result->num_rows() > 0){
            return $result->row();;
        } else {
            return false;
        }
     
    }
}
?>