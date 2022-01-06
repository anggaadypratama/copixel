<?php

    include_once '../utilities/cookiesData.php';

    $cookiesData = getCookies();
    
    header('Content-Type: application/json; charset=utf-8');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_POST['name'];
            $about = $_POST['about'];

            if(empty($_FILES) || !isset($_FILES['img-profile'])){
                $db->select('Users','img_profile',"WHERE id_users='$cookiesData[1]'");
                $res = $db->sql;
                $resVal = $res->fetch_assoc();
                $imgLink = $resVal['img_profile'];

                $res = $db->update('Users',[
                    'name' => $name,
                    'about' => $about,
                    'img_profile' => $imgLink,
                ], "id_users = '$cookiesData[1]'");

                echo json_encode(['status' => true, 'name' => "tanpa gambar"]);
            }else{
                $img = addslashes(file_get_contents($_FILES['img-profile']['tmp_name']));

                $res = $db->update('Users',[
                    'name' => $name,
                    'about' => $about,
                    'img_profile' => $img,
                ], "id_users = '$cookiesData[1]'");

                    echo json_encode(['status' => true, 'name' => $_FILES['img-profile']['tmp_name']]);

            }


        
    }