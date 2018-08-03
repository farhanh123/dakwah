<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class U_Model extends CI_Model {

	 public function register($user)
   {
     $this->db->insert('user', $user);
   }
   public function proseslogin($users,$pass)
   {
     $this->db->where('username', $users);
     $this->db->where('password',$pass);
     return $this->db->get('user')->row();
   }
}
