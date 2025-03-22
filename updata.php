<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location: login.php");
}

require_once("db.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFname = isset($_POST['fname']) ? trim($_POST['fname']) : null;
    $newLname = isset($_POST['lname']) ? trim($_POST['lname']) : null;
    $newEmail = isset($_POST['email']) ? trim($_POST['email']) : null;
    $newPass = isset($_POST['pass']) ? trim($_POST['pass']) : null;

    if ($id && $newFname && $newLname && $newEmail && $newPass) {
        $db = new Database();
        $data = [
            'fname' => $newFname,
            'lname' => $newLname,
            'email' => $newEmail,
            'pass' => $newPass
        ];

        $condition = "id = $id";

        try {
            if ($db->update("employee", $data, $condition)) {
                echo "<p class='success'>Record updated successfully!</p>";
            } else {
                echo "<p class='error'>Failed to update record!</p>";
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    } else {
        echo "<p class='error'>Please fill in all fields!</p>";
    }
}

$db = new Database();
$connection = $db->get_connection();

try {
    $stmt = $connection->prepare("SELECT * FROM employee WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $values = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($values) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <style>
        /* ==== General Styling ==== */
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* ==== Form Styling ==== */
        form {
            background-color: #2a2a40;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #bbb;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #555;
            background-color: #1e1e2f;
            color: #ddd;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6c63ff;
        }

        input[type="submit"] {
            background-color: #6c63ff;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
            letter-spacing: 1px;
        }

        input[type="submit"]:hover {
            background-color: #5246d7;
        }

        /* ==== Feedback Styling ==== */
        .success {
            color: #4caf50;
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: #ff4d4d;
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
        }

        p {
            text-align: center;
            color: #ff4d4d;
            font-size: 16px;
        }
    </style>
</head>
<body>

<form method="post">
    <label for="fname">First Name</label>
    <input type="text" id="fname" value="<?= htmlspecialchars($values['fname']) ?>" placeholder="First Name" name="fname" required>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" value="<?= htmlspecialchars($values['lname']) ?>" placeholder="Last Name" name="lname" required>

    <label for="email">Email</label>
    <input type="email" id="email" value="<?= htmlspecialchars($values['email']) ?>" placeholder="Email" name="email" required>

    <label for="pass">Password</label>
    <input type="password" id="pass" value="<?= htmlspecialchars($values['pass']) ?>" placeholder="Password" name="pass" required>

    <input type="submit" value="Update">
</form>

</body>
</html>

<?php
} else {
    echo "<p class='error'>No record found!</p>";
}
?>
