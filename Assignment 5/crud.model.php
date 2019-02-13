<?php

function getAllPhonebook($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getAllPhonebook failed: " . $e->getMessage() . "\n");
	fclose($logfile);

	exit();
  }	
}

function getPhonebookOrderByFirstName($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook ORDER BY fname");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getPhonebookOrderByFirstName failed: " . $e->getMessage() . "\n");
	fclose($logfile);

	exit();
  }	
}

function getPhonebookOrderByFirstNameDesc($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook ORDER BY fname DESC");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getPhonebookOrderByFirstNameDesc failed: " . $e->getMessage() . "\n");
	fclose($logfile);

	exit();
  }	
}

function getPhonebookOrderByLastName($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook ORDER BY lname");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getPhonebookOrderByLastName failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }	
}

function getPhonebookOrderByLastNameDesc($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook ORDER BY lname DESC");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getPhonebookOrderByLastNameDesc failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }	
}

function getPhonebookOrderByEmail($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook ORDER BY email");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getPhonebookOrderByEmail failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }	
}

function getPhonebookOrderByEmailDesc($conn) 
{
  try {
	
    $stmt = $conn->prepare("SELECT * FROM phonebook ORDER BY email DESC");
	$stmt->execute();
	
	$results = array();
    while ($row = $stmt->fetch())
    {
      $results[] = $row;
    }	
	return $results;
  }
  
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "getPhonebookOrderByEmailDesc failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }	
}

function deletePhonebook($conn, $phonebookid) 
{
  try {
    $stmt = $conn->prepare("DELETE FROM phonebook WHERE id=?");
	$stmt->execute([$phonebookid]);
  }
  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "deletePhonebook failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }		
}

function insertPhonebook($conn, $fname, $lname, $phone, $email, $location, $mc, $pos, $dept) 
{
  try {

	$stmt = $conn->prepare("INSERT INTO phonebook " .
	                      "(id,fname,lname,phone,email,location,mc,pos,dept) VALUES " . 
						  "(?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->execute(["null", $fname, $lname, $phone, $email, $location, $mc, $pos, $dept]);

  }

  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "insertPhonebook failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }		
}

function updatePhonebook($conn, $phonebookid, $fname, $lname, $phone, $email, $location, $mc, $pos, $dept) 
{
  try {

	$stmt = $conn->prepare("UPDATE phonebook SET " .
	                      "fname=?, lname=?, phone=?, email=?, location=?, mc=?, pos=?, dept=? " . 
						  "WHERE id=?");
	$stmt->execute([$fname, $lname, $phone, $email, $location, $mc, $pos, $dept, $phonebookid]);
	

  }

  catch(PDOException $e)
  {

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "updatePhonebook failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	exit();
  }		
}

?>