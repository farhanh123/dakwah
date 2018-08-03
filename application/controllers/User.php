<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	 function __construct(){
     parent::__construct();
     $this->load->model('U_Model');
     $this->load->library('session');
   }
   
   public function index()
   {
     $this->load->view('index.php'); 
   }

   public function register()
   {
     $user=array(
          'name'=>$this->input->post('name'),
          'username'=>$this->input->post('username'),
          'password'=>$this->input->post('password')
     );
     if(!$user['username']=='' && !$user['name']==''){
       $this->U_Model->register($user);
       $this->session->set_flashdata('$smsg',
       'Registration Succes');
       redirect('user/login');
     }
     else{
      $this->session->set_flashdata('$emsg',
      'Registration Succes');
     }
   }

   public function ceklogin()
   {
     if(isset($_POST['login'])){
       $users = $this->input->post('username',true);
       $pass = $this->input->post('password',true);
       $cek = $this->U_Model->proseslogin($users,$pass);
       $hasil = count($cek);
       if($hasil > 0){
         $pelogin = $this->db->get_where('user',array('username' => $users, 'password' => $pass))->row();
         if($pelogin->level == 'admin'){
           redirect('user/admin');
         }elseif($pelogin->level == 'user'){
           redirect('user/guest');
         }elseif($pelogin->level == 'tamir'){
           redirect('user/tamir');
         }
       }else{
          redirect('user/login');
       }
     }
   }

   public function login()
   {
     $this->load->view('login');
   }

   public function registers()
   {
     
    $this->load->view('register'); 
   }

   public function admin()
   {
     $this->load->view('admin/index');
   }
 
   public function guest()
   {
     $this->load->view('guest/index');
   }
 
   public function tamir()
   {
     $this->load->view('tamir/index');
   }

   public function logout()
   {
     $this->session->sess_destroy();
     redirect('user/index');
   }
}
