<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
                                 'admin' => true,
                                 'login'=>false);
	$this->load->library('session');
  }

  public function index()
  {
	  $acl = $this->config->item('acl');
	  
	  if(isset($_SESSION['accesslevel'])){

		  $this->TPL["loggedin"] = true;

		  if($acl["admin"][$_SESSION['accesslevel']] == true){

				$this->getAllUsers();
				$this->template->show('admin', $this->TPL);

		  }else if($acl["admin"][$_SESSION['accesslevel']] == false){

				redirect(base_url() .'index.php?/Members');
				
		  }
	  }else{

			redirect(base_url() .'index.php?/Login');
	  }

  }

  private function getAllUsers()
  {
      $query = $this->db->query("SELECT * FROM usersas6");

      $this->TPL["userresults"] = array();
      foreach ($query->result() as $row)
      {
          $this->TPL["userresults"][] = $row;
      }
  }

    public function deleteUser($id)
    {
    	$this->db->query("DELETE FROM usersas6 WHERE compid=$id");

        $this->getAllUsers();

    	redirect(base_url() .'index.php?/Admin');
    }

	public function addUser()
    {
    	$username = $this->input->post("username");
		$password = $this->input->post("password");
		$accesslevel = $this->input->post("accesslevel");
		$success = true;

		if($username == NULL){
			$success = false;
			$message = "The Username field is required.<br><br>";
		}

		if($password == NULL){
			$success = false;
			$message .= "The Password field is required.<br><br>";
		}
		
		if($accesslevel == NULL){
			$success = false;
			$message .= "Access level must be either member or admin.<br><br>";
		}else if(($accesslevel != "member") && ($accesslevel != "admin")){
			$success = false;
			$message .= "Access level must be either member or admin.<br><br>";
		}

		if($success){
			$userdata = array(
					'username' => $username,
					'password' => $password,
					'accesslevel' => $accesslevel
			);

			$this->db->insert('usersas6', $userdata);
			$this->getAllUsers();
			redirect(base_url() .'index.php?/Admin');
		}else{
			$this->session->set_flashdata("message", $message);
			redirect(base_url() .'index.php?/Admin');

		}
		

    }

}