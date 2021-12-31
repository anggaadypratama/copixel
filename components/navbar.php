<?php
    include_once 'utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = isset($cookiesData) ? (boolean)$cookiesData[0] : false;
    $id = isset($cookiesData) ? $cookiesData[1] : 0;

    $db->select('Users','img_profile',"WHERE id_users='{$id}'");
    $res = $db->sql;
    $resVal = $res->fetch_assoc();
?>


<div class="navbar_section border-bottom">
    <div class="search-icon">
        <div class="logo">
            <a href="process/search.php">
                Copixel
            </a>
        </div>
        <?php if($auth && $id){ ?>
        <form action="?search=udin">
            <div class="search-wrapper">
                <input type="search" name="search" placeholder="Cari gambar...">
                <button type="submit">
                    <div class="fa fa-search"></div>
                </button>
            </div>
        </form>
        <?php } ?>

    </div>

    <div class="upload-auth">
        <?php if($auth){
            echo <<<STR
                <a href="?p=upload" class="btn btn-primary px-3 py-2 btn-upload">Unggah</a>
                <div class="dropdown">
                    <img class="image-profile" loading="lazy" src="{$resVal['img_profile']}"
                        height="50" width="50" alt="profile" id="dropdownProfile" data-bs-toggle="dropdown"
                        aria-expanded="false">
        
                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownProfile">
                        <li><a class="dropdown-item" href="?p=profile&uid={$cookiesData[1]}">Profil</a></li>
                        <li><a class="dropdown-item" href="process/logout.php">Keluar</a></li>
                    </ul>
                </div>
STR;
        }else{
            echo <<<STR
                <a href="?p=auth&s=login" class="btn btn-upload px-3 py-2">Login</a>
                <a href="?p=auth&s=register" class="btn btn-primary px-3 py-2">Register</a>
STR;
        }

        ?>

    </div>

</div>