<?php

function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_token = 'JpBt9UKVOXbPj5B3VnWFHztJYLh0jRRJ';
        $secret_iv = 'Rf5FyKreonfnLGZjafuCvGeBPVYbOn1S';

        $token = hash('sha256', $secret_token);

        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $token, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $token, 0, $iv);
        }
        return $output;
}