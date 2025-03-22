<?php
// echo "delete";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
connection by mysqli 
$connection = new mysqli("localhost","mohamed","Mohamed@8112001","PHP_TEST");
if($connection->errno){
    die("Connection Failed");
}*/
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}
$id = $_GET['id'];

require_once("db.php");
$db = new Database();
// $connection = $db->get_connection();
try {
    $res = $db->delete("employee","id={$_GET['id']}");
    // $res->execute([$id]);
    // $row = $res->fetch(PDO::FETCH_ASSOC);
    header("Location: list.php");
} catch (PDOException $e) {
    echo "Connection Failed " . $e->getMessage();
}
//connection by pdo 
// try {
//     $connection = new pdo("mysql:host=localhost;dbname=PHP_TEST", "mohamed", "Mohamed@8112001");

//     //query
//     $row = $connection->prepare("DELETE FROM employee where id=?");
//     $row->execute([$id]);
//     header("Location: list.php");
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }
// // header("Location:list.php"); 


?>