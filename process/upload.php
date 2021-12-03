<?php

    include '../utilities/cookiesData.php';

    $cookiesData = getCookiesData();
    $auth = (boolean)$cookiesData[0];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['submit'])){
                $target_dir = "image/post/";

                $id_post = rand(1,1000000000);
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $img = $target_dir.basename(time().$_FILES['image-upload']['name']);

                move_uploaded_file($_FILES['image-upload']['tmp_name'], "../$img");

                $res = $db->insert('Post',[
                    'id_post' => $id_post,
                    'title' => $title,
                    'description' => strlen($desc) > 0 ? $desc : NULL,
                    'img_post' => $img,
                    'id_users' => $cookiesData[1],
                    'views' => '0'
                ]);

                if($res === true){
                    header("location: ../?p=profile&uid=$cookiesData[1]");
                }
            }
        }