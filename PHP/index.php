<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            display: block;
            margin: 10px 0; 
        }
    </style>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <button type="submit">Submit</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            print_r($_POST);
            //database connection 
            $connection = new mysqli("localhost:3307", "root", " ", "login_auth");
            if($connection->connect_error){
                die("$connection->$connect_error");
            }
            echo "<br>success<br>";

            $sql = "select * from user where email = '$_POST[email]'";
            $result = $connection->query($sql);
            
            $row = $result->fetch_assoc();
            echo "<pre>";
            print_r($row);
            echo "</pre>";

            $db_email = $row['email'];
            $db_pass = $row['password'];
            
            if($db_pass === $_POST['password']){
                echo "<br>login success<br>";
            }else {
                echo "login failed";
            }

        }
    ?>
</body>
</html>