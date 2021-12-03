<?php

    include '../utilities/cookiesData.php';

    $cookiesData = getCookiesData();
    $auth = (boolean)$cookiesData[0];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['submit'])){
                $pid = $_POST['pid'];
                $title = $_POST['title'];
                $desc = $_POST['desc'];

                if(strlen($_FILES['image']['name']) === 0){
                    $db->select('Post','img_post',"WHERE id_post='$pid'");
                    $res = $db->sql;
                    $resVal = $res->fetch_assoc();
                    $imgLink = $resVal['img_post'];
                    
                    $res = $db->update('Post',[
                        'title' => $title,
                        'description' => $desc,
                        'img_post' => $imgLink,
                    ], "id_post='$pid'");
    
                    var_dump($res);
                    header("location: ../?p=detail-post&pid=$pid");
                }else{
                    $db->select('Post','img_post',"WHERE id_post='$pid'");
                    $res = $db->sql;
                    $resVal = $res->fetch_assoc();
                    unlink("../{$resVal['img_post']}");
    
                    $target_dir = "image/post/";
                    $img = $target_dir.basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], "../$img");
    
                    $res = $db->update('Post',[
                        'title' => $title,
                        'description' => $desc,
                        'img_post' => $img,
                    ], "id_post='$pid'");
    
                        header("location: ../?p=detail-post&pid=$pid");
    
                }
            }
        }