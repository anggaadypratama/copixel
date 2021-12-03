<?php

    include '../utilities/db.php';
    include '../utilities/crypt.php';

    header('Content-Type: application/json; charset=utf-8');

    $db = new DB();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
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

                    echo json_encode(['status' => 'success']);
                }else{
                    echo json_encode(['status' => 'password_salah']);
                }
            }else{
                echo json_encode(['status' => 'email_salah']);
            }
    }