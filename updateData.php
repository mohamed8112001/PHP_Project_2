<?php
// var_dump($_POST);


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//connection 
$connection = new mysqli("localhost","mohamed","Mohamed@8112001","PHP_TEST");
if($connection->errno){
    die("Connection Failed");
}
var_dump($_POST);
$id = $_GET['id'];
// var_dump($id);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
//query

$connection->query("UPDATE employee SET fname = '$fname', lname = '$lname',email = '$email',pass = '$pass' where id = $id  ; ");

// header("Locaion:list.php");
header("Location:list.php");




?>