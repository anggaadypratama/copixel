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
                //             var_dump($res->num_rows == 0);
                // setcookie('token','',time() - 3600,'/');
                echo "<script type=\"text/javascript\">
                    window.location.replace('/process/logout.php')  
                </script>";
            }else{
                return $data;
            }
        }
    }