<?php
    include '../utilities/db.php';

    $db = new DB();
    header('Content-Type: application/json; charset=utf-8');


    if($_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $r_password = $_POST['r_password'];
            $img = addslashes(file_get_contents($_FILES['img-url']['tmp_name'])); 

            $db->select('Users','*',"WHERE email='$email'");
            $res = $db->sql;

            if($res->num_rows === 0){
                if($password === $r_password){
                    $res = $db->insert('Users',[
                        'id_users' => rand(100, 100000000),
                        'name' => ucwords($name),
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'img_profile' => $img
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