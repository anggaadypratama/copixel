<?php

    include '../utilities/db.php';
    include '../utilities/crypt.php';

    $db = new DB();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $db->select('Users','*',"WHERE email='$email'");
            $res = $db->sql;
            $resVal = $res->fetch_assoc();

            if($res->num_rows === 1){

                if(password_verify($password, $resVal['password'])){
                    $token = "true,{$resVal['id_users']}";
                    $encrypt = encrypt_decrypt('encrypt',$token);
                    setcookie("token", $encrypt, time() + (86400 * 30), "/");

                    header('location:../');
                }else{
                    header('location:../?p=auth&s=login&error=password');
                }
            }else{
                header('location:../?p=auth&s=login&error=email');
            }

        }else{
            echo 'belom submit';
        }
    }