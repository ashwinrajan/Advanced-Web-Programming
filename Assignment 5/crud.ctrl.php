<?php

// include database configuration
include "dbheader.php";

// model with database and business logic code
include "crud.model.php";

// make my TPL array at the top, because it might be populated during 
// the switch actions
$TPL = array();

// put code here for things that need to happen every time the page loads
$TPL["phonebook"] = getAllPhonebook($conn);

switch ($_REQUEST["act"]) { 
   
  case "delete":

    $phonebookid = $_REQUEST["id"];
    deletePhonebook($conn, $phonebookid);  
	$TPL["phonebook"] = getAllPhonebook($conn);
   
    break;

  case "insert":
  
    insertPhonebook($conn,
	          $_REQUEST["fname"],
	          $_REQUEST["lname"],
			  $_REQUEST["phone"],
			  $_REQUEST["email"],
			  $_REQUEST["loc"],
			  $_REQUEST["mc"],
			  $_REQUEST["pos"],
			  $_REQUEST["dept"]);
	$TPL["phonebook"] = getAllPhonebook($conn);

	break;

  case "update":
  
    updatePhonebook($conn,
			  $_REQUEST["phoneid"],
	          $_REQUEST["fname2"],
	          $_REQUEST["lname2"],
			  $_REQUEST["phone2"],
			  $_REQUEST["email2"],
			  $_REQUEST["loc2"],
			  $_REQUEST["mc2"],
			  $_REQUEST["pos2"],
			  $_REQUEST["dept2"]);
	$TPL["phonebook"] = getAllPhonebook($conn);

	 break;

   case "orderByFirstName":

		$TPL["phonebook"] = getPhonebookOrderByFirstName($conn);
  
    break;

   case "orderByFirstNameDesc":

		$TPL["phonebook"] = getPhonebookOrderByFirstNameDesc($conn);
  
    break;

   case "orderByLastName":

		$TPL["phonebook"] = getPhonebookOrderByLastName($conn);
  
    break;

   case "orderByLastNameDesc":

		$TPL["phonebook"] = getPhonebookOrderByLastNameDesc($conn);
  
    break;

   case "orderByEmail":

		$TPL["phonebook"] = getPhonebookOrderByEmail($conn);
  
    break;

   case "orderByEmailDesc":

		$TPL["phonebook"] = getPhonebookOrderByEmailDesc($conn);
  
    break;
   
  default:	
	
}

// view with our user interface
include "crud.view.php";

?>