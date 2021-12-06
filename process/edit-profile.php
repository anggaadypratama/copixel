<?php

    include '../utilities/cookiesData.php';

    $cookiesData = getCookiesData();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $about = $_POST['about'];

            if(strlen($_FILES['img-profile']['name']) === 0){
                $db->select('Users','img_profile',"WHERE id_users='$cookiesData[1]'");
                $res = $db->sql;
                $resVal = $res->fetch_assoc();
                $imgLink = $resVal['img_profile'];

                $res = $db->update('Users',[
                    'name' => $name,
                    'about' => $about,
                    'img_profile' => $imgLink,
                ], "id_users = '$cookiesData[1]'");

                header("location: ../?p=profile&uid=$cookiesData[1]");
            }else{
                $db->select('Users',"img_profile","WHERE id_users='$cookiesData[1]'");
                $res = $db->sql;
                $resVal = $res->fetch_assoc();
                unlink("../{$resVal['img_profile']}");

                $target_dir = "image/profile/";
                $img = $target_dir.basename(time()."_".$_FILES['img-profile']['name']);
                move_uploaded_file($_FILES['img-profile']['tmp_name'], "../$img");

                $res = $db->update('Users',[
                    'name' => $name,
                    'about' => $about,
                    'img_profile' => $img,
                ], "id_users = '$cookiesData[1]'");

                    header("location: ../?p=profile&uid=$cookiesData[1]");

            }


        }
    }