<?php
    include '../utilities/db.php';

    $db = new DB();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $target_dir = "image/profile/";

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $imgUrl = $_POST['img-url'];

            $fp = fopen("../$target_dir"."$name.svg","w+");
            fwrite($fp, base64_decode($imgUrl));

            $db->select('Users','*',"WHERE email='$email'");
            $res = $db->sql;
            $resVal = $res->fetch_assoc();

            if($res->num_rows === 0){
                $res = $db->insert('Users',[
                    'id_users' => rand(100, 100000000),
                    'name' => ucwords($name),
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'img_profile' => "$target_dir$name.svg"
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