<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

    // is the user logged in or not?
    $this->TPL["loggedin"] = false;

    // which page is active?
    $this->TPL['active'] = array('home' => false,
                                 'members'=>true,
                                 'admin' => false,
                                 'login'=>true);
	$this->load->library('session');
  }

  public function index()
  {
	  $acl = $this->config->item('acl');

	  if(isset($_SESSION['accesslevel'])){

		  $this->TPL["loggedin"] = true;

		  if($acl["members"][$_SESSION['accesslevel']] == true){

				$this->template->show('members', $this->TPL);

		  }else if($acl["members"][$_SESSION['accesslevel']] == false){
			
				redirect(base_url() .'index.php?/Login');
		  }

	  }else{
			
			redirect(base_url() .'index.php?/Login');

	  }
  }
}