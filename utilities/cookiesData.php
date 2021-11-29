<?php

    include 'crypt.php';

    function getCookiesData(){
        if(isset($_COOKIE['key'])){
            $key = $_COOKIE['key'];
            $decrypt = encrypt_decrypt('decrypt',$key);
            $data = explode(',',$decrypt);

            return $data;
        }
    }