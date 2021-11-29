<?php
    include '../utilities/db.php';

    $db = new DB();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $db->select('Users','*',"email='$email'");
            $res = $db->sql;
            $resVal = $res->fetch_assoc();

            if($res->num_rows === 0){
                $res = $db->insert('Users',[
                    'id_users' => rand(100, 100000000),
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ]);

                if($res === true){
                    header('location: ../?p=auth&s=login&message=reg_success');
                }
            }else{
                header('location:../?p=auth&s=login&error=user_exist');
            }
        }
    }

    // echo $email;