<?php
    include 'config.php';
    $message = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if(empty($username) || empty($password)){
            $message = "All Fields are required";
        }
        else{
            $check_user = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn-> query($check_user);
            if($result-> num_rows>0){
                $message = "Username already exist";
            }
            else{
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password' )";
                if($conn->query($sql) === TRUE){
                    $message = "User Registered Successfully!";
                }
                else{
                    $message = "Error: ".$conn->error;
                }
            }
        }
    }

?>