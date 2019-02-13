<!DOCTYPE html>
<html>
  <head>
    <title>Student Payment Form</title>
    <style>

      input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
      }

      select {
        width: 100%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #f1f1f1;
        font-size:14px;
        margin-top: 7px;
        margin-bottom: 7px;

      }

      input[type=button], input[type=submit], input[type=reset] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 16px 32px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
      }

      .success {
        font-size: 20px;
        color: green;
      }

      .error {
      	font-size: 20px;
      	color: red;
      }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  </head>
<body>
  
  <!-- Form solution code here !-->
  <div id="header">
	<h1>Student Payment Form</h1>
  </div>

  <div>
	  <form action="form.php" method="post">
		<label for="fname">First Name</label>
		<input type="text" id="fname" name="firstname">

		<label for="lname">Last Name</label>
		<input type="text" id="lname" name="lastname">

		<label for="sId">Student ID</label>
		<input type="text" id="sId" name="studentId">

		<label for="tuition">Tuition</label>
		<input type="text" id="tuition" name="tuition">

		<label for="payMethod">Payment Method</label>
		<select id="payMethod" name="payMethod">
		  <option value="Credit">Credit</option>
		  <option value="Debit">Debit</option>
		  <option value="Bitcoin">Bitcoin</option>
		</select>
	  
		<input type="submit" value="Submit">
		<input type="button" id="random" value="Random"">
		<input type="button" id="log" value="Log"">
		
	  </form>
  </div>
	<div id="output"></div>
  <br /> 

<?php 

  // PHP solution code here
  if ($_SERVER['REQUEST_METHOD']== "POST") {
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$studentId = $_POST['studentId'];
	$tuition = $_POST['tuition'];
	$payMethod = $_POST['payMethod'];
	$success = true;
	
	?><div class="error"><ul><?php 

	if (strlen($firstname) < 2){
		?><li>First name must be 2 or more characters in length</li><?php 
		$success = false; //false
	}

	if ((strlen($lastname) < 3) || (strlen($lastname) > 12)){
		?><li>Last name must be between 3 and 12 characters in length</li><?php 
		$success = false; //false
	}

	if (strlen($studentId) != 9){
		?><li>Student id must be exactly 9 characters in length</li><?php 
		$success = false; //false
	}

	if (($tuition < 2000) || ($tuition > 10000)){
		?><li>Tuition must be between 2000 and 10000</li><?php 
		$success = false; //false
	}

	?></ul></div><?php

	if($success){
		?><div class="success">Payment Sucessful!</div><?php 

		$data = array($firstname,$lastname,$studentId,$tuition, $payMethod);

		$logfile = fopen("log.txt", "a") or die("Unable to open file!");

		fputcsv($logfile, $data);
		fclose($logfile);
		
	}
	
  }
?>

<script>

  // JavaScript solution code here
  $(document).ready(function() 
  {
	$("#log").click (
      function()
      {
		window.location.href = 'log.txt';
	  }
	 );

	$("#random").click (
	  function()
	  {
		$.post("rangen.php",
	      {},
		  function(data) {
		     $("#fname").val(data["firstname"]);
			 $("#lname").val(data["lastname"]);
			 $("#sId").val(data["studentid"]);
			 $("#tuition").val(data["tuition"]);
			 $("#payMethod").val(data["method"]);
		  },
		  "json");
	  }
	 );
  });

</script>
</body>
</html>