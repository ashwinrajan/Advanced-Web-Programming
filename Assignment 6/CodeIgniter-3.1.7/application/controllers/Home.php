<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

    // is the user logged in or not?
    $this->TPL["loggedin"] = false;

    // which page is active?
    $this->TPL['active'] = array('home' => true,
                                 'members'=>false,
                                 'admin' => false,
                                 'login'=>false);

	$this->load->library('session');
  }

  public function index()
  {
	  if(isset($_SESSION['accesslevel'])){

			$this->TPL["loggedin"] = true;
	  }

	  $this->template->show('home', $this->TPL);
  }
}