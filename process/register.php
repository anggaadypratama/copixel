<?php
    include '../utilities/db.php';

    $db = new DB();
    header('Content-Type: application/json; charset=utf-8');


    if($_SERVER['REQUEST_METHOD'] == "POST"){
            $target_dir = "image/profile/";

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $r_password = $_POST['r_password'];
            $imgUrl = $_POST['img-url']; 

            $nameOfImage = time()."_$name";

            $fp = fopen("../$target_dir"."$nameOfImage.svg","w+");
            fwrite($fp, base64_decode($imgUrl));

            $db->select('Users','*',"WHERE email='$email'");
            $res = $db->sql;
            $resVal = $res->fetch_assoc();

            if($res->num_rows === 0){
                if($password === $r_password){
                    $res = $db->insert('Users',[
                        'id_users' => rand(100, 100000000),
                        'name' => ucwords($name),
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'img_profile' => "$target_dir$nameOfImage.svg"
                    ]);
    
                    if($res === true){
                        echo json_encode(['status' => 'success']);
                    }
                }else{
                    echo json_encode(['status' => 'pass_not_match']);
                }
            }else{
                echo json_encode(['status' => 'email_exists']);
            }

            
    }

    // echo $email;