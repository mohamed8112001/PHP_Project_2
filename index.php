    <?php
    $errors = [];
    if (isset($_GET['errors'])) {
        $errors = json_decode($_GET['errors'], true);
    }
    session_start();
    if(!isset($_SESSION['email']))
    {
        header("Location: login.php");  
    }
    echo "Hello ". $_SESSION['fname'] ." ". $_SESSION['lname'];
    ?>  

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>
        <style>
            /* ========== General Styles ========== */
            body {
                background: linear-gradient(135deg, #1c1c2e, #32324e);
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: #f0f0f0;
                margin: 0;
                flex-direction: column;
            }

            header {
                position: absolute;
                top: 20px;
                text-align: center;
                color: #6c63ff;
                font-size: 32px;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            /* ========== Form Styling ========== */
            form {
                background-color: #28283c;
                padding: 30px;
                border-radius: 14px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
                width: 400px;
                display: flex;
                flex-direction: column;
                gap: 18px;
                transition: transform 0.3s ease;
            }

            form:hover {
                transform: translateY(-5px);
            }

            /* ========== Input Styling ========== */
            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 14px;
                border: 1px solid #444;
                background-color: #1c1c2e;
                color: #ddd;
                border-radius: 8px;
                font-size: 16px;
                outline: none;
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.5);
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: #6c63ff;
                box-shadow: 0 0 12px rgba(108, 99, 255, 0.8);
            }

            /* ========== Submit Button ========== */
            input[type="submit"] {
                background-color: #6c63ff;
                color: #fff;
                border: none;
                padding: 14px;
                font-size: 18px;
                border-radius: 10px;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
                box-shadow: 0 4px 12px rgba(108, 99, 255, 0.5);
                font-weight: bold;
                letter-spacing: 1px;
            }

            input[type="submit"]:hover {
                background-color: #5246d7;
                transform: translateY(-3px);
                box-shadow: 0 6px 16px rgba(108, 99, 255, 0.7);
            }

            /* ========== Label Styling ========== */
            label {
                font-size: 14px;
                color: #bbb;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* ========== Error Container ========== */
            .error-container {
                background-color: #ff4d4d;
                color: #fff;
                padding: 12px;
                border: 1px solid #e04343;
                border-radius: 8px;
                margin-bottom: 20px;
                font-size: 16px;
                box-shadow: 0 4px 8px rgba(255, 77, 77, 0.4);
                width: 400px;
                text-align: left;
                opacity: 0;
                transform: translateY(-10px);
                animation: fadeIn 0.4s forwards;
            }

            .error-container ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .error-container li {
                margin-bottom: 6px;
                font-size: 15px;
                font-weight: bold;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            /* ========== Individual Error Styling ========== */
            .input-error {
                border-color: #ff4d4d;
                box-shadow: 0 0 10px rgba(255, 77, 77, 0.7);
            }

            .error-message {
                color: #ff4d4d;
                font-size: 14px;
                margin-top: -10px;
                font-weight: bold;
                display: block;
                animation: fadeIn 0.3s forwards;
            }

            /* ========== Error Icon ========== */
            .error-icon {
                color: #ff4d4d;
                font-size: 16px;
            }

            /* ========== Animations ========== */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body>

    <header>Register</header>

    <!-- Error Messages -->
    <?php if (!empty($errors)): ?>
        <div class="error-container">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>⚠️ <?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="post" action="data.php">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" placeholder="First Name" required
            class="<?php echo isset($errors['fname']) ? 'input-error' : ''; ?>">
        <?php if (isset($errors['fname'])): ?>
            <span class="error-message">⚠️ <?php echo $errors['fname']; ?></span>
        <?php endif; ?>

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Last Name" required
            class="<?php echo isset($errors['lname']) ? 'input-error' : ''; ?>">
        <?php if (isset($errors['lname'])): ?>
            <span class="error-message">⚠️ <?php echo $errors['lname']; ?></span>
        <?php endif; ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required
            class="<?php echo isset($errors['email']) ? 'input-error' : ''; ?>">
        <?php if (isset($errors['email'])): ?>
            <span class="error-message">⚠️ <?php echo $errors['email']; ?></span>
        <?php endif; ?>

        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass" placeholder="Password" required>

        <input type="submit" name="register" value="Register">
    </form>

    </body>
    </html>


    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // echo "Hello World!" . "<br>";
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";
    // $x = 10 ; 
    function add($y, $x)
    {
        // global $x ;
        $z = $x + $y;
        echo (gettype($z));
        echo $z;
    }
    // add(10,10);

    $array = [1, 2, 3, 4, 5, 6, 7, 8];
    // for($i=0;$i<count($array);$i++){
    //     echo $array[$i]."<br>";
    // }
    // $value = 0 ;
    // "<ul>";
    // foreach ($array as $value) {
    //     echo "<li>".$value."</li>";
    // }
    // "</ul>";



    // // open file
    // $file = fopen('data.txt','a+');
    // // write in file
    // // fwrite($file,"Mohamed,Mustafa,23");
    // fwrite($file,"\hamdy,Mustafa,23");
    // // close file
    // fclose($file);
    // ==================any variable is CAPITAL without $ called const variable=========== 
    // open file
    // $file = fopen('data.txt','r');
    // // read from file
    // // fwrite($file,"Mohamed,Mustafa,23");
    // rewind($file);
    // echo "<ul>";
    // while(!feof($file))
    // {
    //     $data = fgets(stream: $file);
    //     echo("<li>".$data."</li>");
    // }
    // echo "</ul>";

    // $data = fgets(stream: $file);
    // var_dump($data);
    // $data = fgets(stream: $file);
    // var_dump($data);
    // close file
    // fclose($file)

    // $file = 'data.txt';
    // file_put_contents("data.txt","\n"."mohamed,mustafa,23",FILE_APPEND);
    // var_dump(file_get_contents("data.txt"));
    // $file = file('data.txt');
    // var_dump($file)


    // $array = [
    //     [
    //         "id" => 1,
    //         "name" => "mohamd",
    //         "email" => "mohamed@gmail.com"
    //     ],
    //     [
    //         "id" => 2,
    //         "name" => "mustafa",
    //         "email" => "mustafa@gmail.com"
    //     ],
    //     [
    //         "id" => 3,
    //         "name" => "gamal",
    //         "email" => "gamal@gmail.com"
    //     ]
    // ];
    // echo "
    //     <table border =2>
    //     <tr>
    //     <th>ID</th>
    //     <th>Name</th>
    //     <th>Email</th>
    //     </tr>";

    // foreach ($array as $elm) {
    //     "<tr>";
    //     foreach ($elm as $value) {
    //         echo "<td>" . $value . "</td>";
    //     }
    //     echo "</tr>";
    // }
    // echo "</table>";

    // $arr = explode(",","mohamed,mustafa,23,mohamed@gmail.com");
    // foreach($arr as $e)
    // {
    //     echo $e ."<br>" ;
    // }$arr = explode(",","mohamed,mustafa,23,mohamed@gmail.com");
    // foreach($arr as $e)
    // {
    //     echo $e ."<br>" ;
    // }

    // $arr =  [
    //     "id" => 2,
    //     "name" => "mustafa",
    //     "email" => "mustafa@gmail.com"
    // ];
    // $new = implode(" ",$arr);
    // echo $new ;
    // // print_r($arr) ;
    // ?>