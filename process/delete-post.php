<?php
    include '../utilities/cookiesData.php';

    $pid = $_GET['pid'];
    $uid = $_GET['uid'];

    $db->select('Post',"img_post","WHERE id_post='$pid'");
    $res = $db->sql;

    $resVal = $res->fetch_assoc();
    unlink("../{$resVal['img_post']}");

    $db->delete('Post',"id_post='$pid'");

    header("location: /copixel?p=profile&uid=$uid");