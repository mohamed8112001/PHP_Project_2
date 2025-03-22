<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #2a2a40;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #444;
            color: #ddd;
        }

        th {
            background-color: #6c63ff;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:hover {
            background-color: #39395d;
            transition: background-color 0.3s ease;
        }

        td {
            font-size: 16px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .actions a {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 5px;
            font-size: 14px;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .delete {
            background-color: #ff4d4d;
        }

        .delete:hover {
            background-color: #e04343;
        }

        .update {
            background-color: #6c63ff;
        }

        .update:hover {
            background-color: #5246d7;
        }

        .view {
            background-color: #4caf50;
        }

        .view:hover {
            background-color: #449d48;
        }
    </style>
</head>

<body>
    <h3><a href="index.php">Add User</a></h3>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>

        <?php
        session_start();
        if (!isset($_SESSION['email'])) {
            header("Location: login.php");
        }
        require_once("db.php");
        $db = new Database();
        $connection = $db->get_connection();
        try {
            $res = $db->select("employee");
            // $res = $connection->query("SELECT * FROM employee;");
            $rows = $res->fetchAll(PDO::FETCH_BOTH);
        } catch (PDOException $e) {
            echo "Connection Failed " . $e->getMessage();
        }

        foreach ($rows as $row):
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['fname'] ?></td>
                <td><?= $row['lname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['pass'] ?></td>
                <td class="actions">
                    <a href="delete.php?id=<?= $row['id'] ?>" class="delete">Delete</a>
                    <a href="updata.php?id=<?= $row['id'] ?>" class="update">Update</a>
                    <a href="view.php?id=<?= $row['id'] ?>" class="view">View</a>
                </td>

            </tr>
        <?php endforeach; ?>

    </table>

    <?php

    $connection = null;
    ?>

</body>

</html>