<?php
    include '../utilities/cookiesData.php';

    $cid = $_GET['cid'];
    $pid = $_GET['pid'];
    
    $db->delete('Comment',"id_comment='$cid'");

    header("location: /copixel?p=detail-post&pid=$pid");
    