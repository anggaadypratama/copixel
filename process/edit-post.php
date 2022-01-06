<?php

    include_once '../utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = (boolean)$cookiesData[0];

    header('Content-Type: application/json; charset=utf-8');

        if($_SERVER['REQUEST_METHOD'] == "POST"){
                $pid = $_POST['pid'];
                $title = $_POST['title'];
                $desc = $_POST['desc'];

                if(empty($_FILES) || !isset($_FILES['image-form-edit'])){
                    $res = $db->update('Post',[
                        'title' => $title,
                        'description' => $desc,
                    ], "id_post='$pid'");

                    echo json_encode(["status" => true, 'uid' => $cookiesData[1], 'res' => $res]);
                }else{
                    $img = addslashes(file_get_contents($_FILES['image-form-edit']['tmp_name']));
    
                    $res = $db->update('Post',[
                        'title' => $title,
                        'description' => $desc,
                        'img_post' => $img,
                    ], "id_post='$pid'");

                    echo json_encode(["status" => true, 'uid' => $cookiesData[1]]);
                }
            
        }