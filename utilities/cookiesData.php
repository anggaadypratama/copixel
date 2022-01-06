<?php

    include_once 'crypt.php';
    include_once 'db.php';

    $db = new DB();

    function getCookies(){
        if(isset($_COOKIE['token'])){
            $tokenSession = $_COOKIE['token'];
            $decrypt = encrypt_decrypt('decrypt',$tokenSession);
            $data = explode(',',$decrypt);
            
            $db = new DB();

            $db->select('Users','*',"WHERE id_users='$data[1]'");
            $res = $db->sql;

            if($res->num_rows === 0){
                setcookie('tokenSession','',time() - 3600,'/');
                header('location: /copixel');
            }else{
                return $data;
            }
        }
    }