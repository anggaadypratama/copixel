<?php

    include 'crypt.php';
    include 'db.php';

    $db = new DB();


    function getCookiesData(){
        if(isset($_COOKIE['token'])){


            $token = $_COOKIE['token'];
            $decrypt = encrypt_decrypt('decrypt',$token);
            $data = explode(',',$decrypt);

            $db = new DB();
            
            $db->select('Users','*',"WHERE id_users='$data[1]'");
            $res = $db->sql;

            if($res->num_rows === 0){
                setcookie('token','',time() - 3600,'/');
                header('location: /copixel');
            }else{

            return $data;
            }
        }
    }