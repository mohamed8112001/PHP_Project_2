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
            width: 400px;
            max-width: 90%;
            transition: transform 0.3s ease;
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
            padding: 14px;
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

        /* زر العودة */
        .back-btn {
            display: block;
            margin-top: 20px;
            padding: 12px;
            background-color: #6c63ff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .back-btn:hover {
            background-color: #5246d7;
            transform: translateY(-2px);
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

            session_start();
            if (!isset($_SESSION['email'])) {
                header("Location: login.php");
                exit;
            }

            if (isset($_GET['id'])) {
                require_once("db.php");
                $db = new Database();

                try {
                    $id = intval($_GET['id']); 
                    $res = $db->select("employee", "id={$id}");
                    $row = $res->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        foreach ($row as $key => $value) {
                            echo "<li><strong>" . ucfirst($key) . ":</strong> " . htmlspecialchars($value) . "</li>";
                        }
                    } else {
                        echo "<li>No employee found with ID: $id</li>";
                    }
                } catch (PDOException $e) {
                    echo "<li>Error: " . htmlspecialchars($e->getMessage()) . "</li>";
                }
            } else {
                echo "<li>Invalid ID provided.</li>";
            }
            ?>
        </ul>

        <a href="list.php" class="back-btn">Back to Employees</a>
    </div>
</body>

</html>
