<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #2a2a40;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
            width: 350px;
        }

        h2 {
            color: #6c63ff;
            border-bottom: 2px solid #6c63ff;
            padding-bottom: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            padding: 12px;
            border-bottom: 1px solid #444;
            font-size: 18px;
            color: #ddd;
            transition: background-color 0.3s ease;
        }

        li:last-child {
            border-bottom: none;
        }

        li:hover {
            background-color: #383856;
        }
    </style>
</head>

<body>
    <div class="container">

        <h2>Employee Details</h2>
        <ul>
            <?php

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            // echo "view";
            session_start();
            if (!isset($_SESSION['email'])) {
                header("Location: login.php");
            }
            //connection 
            $id = $_GET['id'];
            // var_dump($_GET['id']);
            
            require_once("db.php");
            $db = new Database();
            // $connection = $db->get_connection();
            try {
                $res = $db->select("employee","id={$_GET['id']}");
                // $res->execute([$id]);
                $row = $res->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Connection Failed " . $e->getMessage();
            }
            // try{
            // $connection = new PDO("mysql:host=localhost;dbname=PHP_TEST", "mohamed", "Mohamed@8112001", );
// if ($connection->errno) {
//     die("Connection Falied");
// }
            
            //query 
// replace $connection->query by ->prepare then the output->execute
// $res = $connection->query("SELECT *FROM employee WHERE id=$id ;");
// $res = $connection->prepare(query: "SELECT *FROM employee WHERE id=?");
// $res->execute([$id]);
// $row = $res->fetch(PDO::FETCH_ASSOC);
            



            foreach ($row as $value) {
                echo "<li>" . $value . "</li>";
            }
            echo "</ul> 
</div>

</body>
</html>
";

            // // }
// catch(PDOException $e){
//     echo "Connection falied".$e->getMessage();
// }
            ?>