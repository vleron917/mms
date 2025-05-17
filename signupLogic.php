
<?php

   include_once "config.php" ;

    if (isset($_POST['submit'])) {
        $name =  $_POST['name'];
        $username =  $_POST['username'];
        $email =  $_POST['email'];
        $tempPassword =  $_POST['password'];
        $password = password_hash($tempPassword, PASSWORD_DEFAULT);

        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            echo "You need to fill all the fields";

            header("refresh:3 url=signup.php");
        } else {
            $sql = "SELECT username FROM users WHERE username=:username";

            $tempSql = $conn->prepare($sql);
            $tempSql->bindParam(":username", $username);
            $tempSql->execute();

            if ($tempSql->rowCount() > 0) {
                echo "Username exists!";
                header("refresh:3 url=signup.php");
            } else {
                $sql = "INSERT INTO users(name,username,email, password, confirm_password, is_admin) VALUES (:name , :username, :email, :password,:confirm_password, :is_admin)";
            
                $tempSql = $conn->prepare($sql);
                $is_admin = 0;
                $tempSql->bindParam(":name", $username);
                $tempSql->bindParam(":email", $email);
                $tempSql->bindParam(":username", $username);
                $tempSql->bindParam(":password", $password);
                $tempSql->bindParam(":confirm_password", $password);
                $tempSql->bindParam(":is_admin", $is_admin);
                $tempSql->execute();

            }


        }
    }      
    