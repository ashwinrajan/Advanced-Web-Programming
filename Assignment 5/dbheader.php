<?php

// database configuration
$DB["username"] = "root";
$DB["password"] = "mysql";
$DB["host"] = "localhost";
$DB["dbname"] = "crud";


// make the database connection 
try {
    $conn = new PDO("mysql:host=" . $DB["host"] .";".
	                "dbname=" . $DB["dbname"], 
	                $DB["username"], 
					$DB["password"]);
					
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// have my fetch data returned as an associative array
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{

	$logfile = fopen("errorlog.txt", "a") or die("Unable to open file!");

	fwrite($logfile, "Connection failed: " . $e->getMessage() . "\n");
	fclose($logfile);
	
	exit();
}

?>