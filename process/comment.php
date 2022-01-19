<?php
    include '../utilities/cookiesData.php';

    $cookiesData = getCookies();

    $pid = $_POST['pid'];
    $comment = $_POST['comment'];


    if(isset($pid) !== null && isset($comment) !== null && $cookiesData[1] !== null){
        $res = $db->insert('Comment',[
            'id_comment' => rand(1,1000000000),
            'body' => $comment,
            'id_post' => $pid,
            'id_users' => $cookiesData[1]
        ]);
    
        if($res === true){
            header("location: ../copixel?p=detail-post&pid=$pid");
        }
    }