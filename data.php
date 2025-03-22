<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('db.php');
if (isset($_POST['register'])) {


    $fname = validation($_POST['fname']);
    $lname = validation($_POST['lname']);
    $email = validation($_POST['email']);
    $pass = validation($_POST['pass']);
    // $id = validation($_POST['id']);

    $errors = [];

    if (strlen($fname) < 3) {
        $errors['fname'] = "The First Name should be 3 chars or more.";
    }

    if (strlen($lname) < 3) {
        $errors['lname'] = "The Lirst Name should be 3 chars or more.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "The Email not valid.";
    }

    if (count($errors) > 0) {
        // var_dump($errors);
        header("Location:index.php?errors=" . json_encode($errors));
    } else {

        try {
            $db = new Database();
            
            $db->insert("employee","fname,lname,email,pass",[$fname, $lname,$email,$pass]);
            // $connection = new PDO("mysql:host=localhost;dbname=PHP_TEST", "mohamed", "Mohamed@8112001");

            // $stm = $connection->prepare("insert into employee(fname,lname,email,pass)
    // values(?,?,?,?)");
            // $stm->execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['pass']]);
            header("Location: list.php");
        } catch (PDOException $e) {
            echo "Connection Falied" . $e->getMessage();
        }


    }
}

if (isset($_POST['submit'])) {


    $email = validation($_POST['email']);
    $password = validation($_POST['password']);

    $errors = [];

    // if (strlen($email) < 3) {
    //     $errors['fname'] = "The First Name should be 3 chars or more.";
    // }

    if (strlen($password) < 8) {
        $errors['password'] = "The Password should be 8 or more chars.";
    } else if (!preg_match('/[a-zA-Z]/', $password)) {
        $errors['password'] = 'Password must contain at least one uppercase and lowercase letter.';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must contain at least one number.';
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "The Email not valid.";
    }

    if (count($errors) > 0) {
        // var_dump($errors);
        header("Location:login.php?errors=" . json_encode($errors));
    } else {
        //connection 
        
        try {
            $connection = new PDO("mysql:host=localhost;dbname=PHP_TEST", "mohamed", "Mohamed@8112001");
            $res = $connection->prepare("SELECT *FROM employee where email=? and pass=?");
            $res->execute([$_POST['email'],$_POST['password']]);
            $data = $res->fetch(PDO::FETCH_ASSOC);
            if($data){
                // store data in cookie and expired the data after 60 s
                var_dump($data);
                // var_dump($data);
                session_start();
                $_SESSION['email']=$data['email'];
                $_SESSION['fname']=$data['fname'];
                $_SESSION['lname']=$data['lname'];
                header("Location: index.php");
            }
            else{
                
                header("Location: login.php?errors=1");
            }
            // var_dump($data);
        }catch(PDOException $e){
            echo "Falied Connection " . $e->getMessage();
        }


        // else
        // {
        //     header("Location:index.php");

        // }

        //     try {
        //         $connection = new PDO("mysql:host=localhost;dbname=PHP_TEST", "mohamed", "Mohamed@8112001");

        //         $stm = $connection->prepare("insert into employee(fname,lname,email,pass)
        // values(?,?,?,?)");
        //         $stm->execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['pass']]);
        //         header("Location: list.php");
        //     } catch (PDOException $e) {
        //         echo "Connection Falied" . $e->getMessage();
        //     }


    }
}

function validation($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

$connection = null;

?>