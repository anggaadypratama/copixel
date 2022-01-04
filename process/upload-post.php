<?php

    include_once '../utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = (boolean)$cookiesData[0];

    header('Content-Type: application/json; charset=utf-8');

        if($_SERVER['REQUEST_METHOD'] == "POST"){
                $target_dir = "image/post/";

                $id_post = rand(1,1000000000);
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $img = $target_dir.basename(time()."_".$_FILES['image-form-upload']['name']);

                move_uploaded_file($_FILES['image-form-upload']['tmp_name'], "../$img");

                $res = $db->insert('Post',[
                    'id_post' => $id_post,
                    'title' => $title,
                    'description' => strlen($desc) > 0 ? $desc : NULL,
                    'img_post' => $img,
                    'id_users' => $cookiesData[1],
                    'views' => '0'
                ]);

                // echo json_encode(['status' => true, 'uid' => $cookiesData[1]]);


                if($res === true){
                    echo json_encode(['status' => true, 'uid' => $cookiesData[1]]);

                    // header("location: ../?p=profile&uid=$cookiesData[1]");
                }else{
                    echo json_encode(['status' => false]);
                }
        }