<?php
    include '../utilities/cookiesData.php';

    $cid = $_GET['cid'];
    $pid = $_GET['pid'];
    
    $db->delete('Comment',"id_comment='$cid'");

    echo "<script type=\"text/javascript\">
        window.location.replace('/?p=detail-post&pid=$pid')
        </script>";
    