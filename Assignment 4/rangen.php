<?php

// Randomly generate data for a student and return it as JSON data

// possible random first names
$firstname = array("Kevin", "John", "Sally", "Larissa", 
                   "Zhang", "Li", "Ying", "Wang",
                   "Nayla", "Nawal", "Abdul", "Yasin");

// possible random last names
$lastname = array("Browne", "Black", "Smith", "Yendt",
                  "Wei", "Fang", "Patel", "Lee",
                  "Abaza", "Shadid", "Hatem", "Hassin");

// random generation of tuition
$tuition = rand(2800, 7956);

// random generation of a student id
$studentid = 
  "0" . rand(0, 9) . rand(0,9) . rand(0,9) . rand(0,9) .
  rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);

// possible payment methods
$paymentmethods = array("Credit", "Debit", "Bitcoin");

// create random student based on arrays, randomness
$student = 
  array(
    "firstname" => $firstname[rand(1,count($firstname)) - 1],
    "lastname" => $lastname[rand(1, count($lastname)) - 1],
    "tuition" => $tuition,
    "studentid" => $studentid,
    "method" => $paymentmethods[rand(1, count($paymentmethods)) - 1]
  );

// send back a student as JSON data
echo json_encode($student);

?>