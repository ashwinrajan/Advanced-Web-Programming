<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

    // is the user logged in or not?
    $this->TPL["loggedin"] = false;

    // which page is active?
    $this->TPL['active'] = array('home' => false,
                                 'members'=>false,
                                 'admin' => false,
                                 'login'=>true);
	$this->load->library('session');
  }

  public function index()
  {
    $this->template->show('login', $this->TPL);
  }

  public function authentication()
  {
	$username = $this->input->post("username");
	$password = $this->input->post("password");
	$this->db->select("*");
	$this->db->from("usersas6");
	$this->db->where("username",$username);
	$this->db->where("password",$password);
	$query = $this->db->get();

	if($query->num_rows() > 0)
	{
		$row = $query->row();
		$accesslevel = $row->accesslevel;
		if ($accesslevel == 'member'){
			$userdata = array(
			'username'  => $username,
			'accesslevel' => $row->accesslevel,
			'basepage' => base_url() .'index.php?/Members',
			);

			$this->session->set_userdata($userdata);
			$this->TPL["loggedin"] = true;
			redirect(base_url() .'index.php?/Members');
		}else if($accesslevel == 'admin'){
			$userdata = array(
			'username'  => $username,
			'accesslevel' => $row->accesslevel,
			'basepage' => base_url() .'index.php?/Admin',
			);

			$this->session->set_userdata($userdata);
			$this->TPL["loggedin"] = true;
			redirect(base_url() .'index.php?/Admin');
			
		}
	}
	else{

		$this->session->set_flashdata("message", "Error invalid username and password");
		$this->TPL["loggedin"] = false;
		redirect(base_url() .'index.php?/Login');
	}
  }

  public function logout(){

	session_destroy();
	$this->TPL["loggedin"] = false;
	redirect(base_url() .'index.php?/Home');

  }
}