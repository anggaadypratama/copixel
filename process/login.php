<?php

    include '../utilities/db.php';
    include '../utilities/crypt.php';

    $db = new DB();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $db->select('Users','*',"email='$email'");
            $res = $db->sql;
            $resVal = $res->fetch_assoc();

            if($res->num_rows === 1){

                if(password_verify($password, $resVal['password'])){
                    $key = "true,{$resVal['id_users']},{$resVal['name']},{$resVal['img_profile']}";
                    $encrypt = encrypt_decrypt('encrypt',$key);
                    setcookie("key", $encrypt, time() + (86400 * 30), "/");

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