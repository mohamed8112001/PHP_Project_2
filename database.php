<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connection 
//create object from class mysqli to make connection between mysql and php
$connection = new mysqli("localhost","mohamed","Mohamed@8112001","PHP_TEST");
if($connection->connect_errno){

    // echo "Connection Failed" ;
    // exit;
    // ==
    //die print message and exit 
    die("Connection Failed");
}

//query
//the object call function called query to execute the query 
$stm = $connection->prepare("insert into employee(fname,lname,email,pass)
values(?,?,?,?)");
$stm->execute([$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['pass']]);
// '{$_POST['fname']}','{$_POST['lname']}','{$_POST['email']}','{$_POST['pass']}')
//close connection 
$connection->close();
header("Location:list.php");

?>