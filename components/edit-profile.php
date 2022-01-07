<?php
    include_once 'utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = (boolean)$cookiesData[0];

    $db = new DB();

    $uid = $_GET['uid'];

    $db->select('Users','*',"WHERE id_users='$uid'");
    $res = $db->sql;
    $resVal = $res->fetch_assoc();

    // header("Content-type: image/webp");
    // echo base64_encode($resVal['img_profile']);
    $img = base64_encode($resVal['img_profile']);
?>

<form method="post" enctype="multipart/form-data" id="edit-profile-form" class="edit-profile-form">
    <div class="image-profile">
        <label for="img-profile">
            <img loading="lazy" src="<?= "data:image/webp;base64,$img"?>" id="profile-img" alt="img-profile">
            <div class="overlay disabled" id="img-profile-overlay">
                <i class="fas fa-user-edit"></i>
            </div>

        </label>
        <input type="file" accept="image/png, image/jpg, image/jpeg" name="img-profile" id="img-profile" disabled>

    </div>
    <div class="user-form ml-5">
        <input class="user-form__name <?= $uid !== $cookiesData[1] ? 'user' : '' ?>" type="text" name="name"
            placeholder="Tidak Boleh Kosong" value="<?= ucwords($resVal['name']) ?>" maxlength="20" id="name-profile"
            required disabled>
        <input class="user-form__desc mt-2" type="text" name="about" maxlength="49"
            placeholder="<?= $auth && ($uid === $cookiesData[1]) ? 'Isi tentang kamu...' : ''?>"
            value="<?= $resVal['about'] ?>" maxlength="50" id="desc-profile" disabled>
        <?php if($auth && $uid === $cookiesData[1]){
            echo <<<STR
                <div class="edit-button mt-4">
                    <button type="button" class="btn rounded btn-outline-secondary btn-sm" id="edit-btn"
                        >
                        Edit Profile
                    </button>
                    <input class="btn rounded btn-primary btn-sm mx-2 submit-profile disabled" id="edit-btn-submit" name="submit" type="submit" value="Simpan">
                </div>
STR;
        }
        ?>

    </div>
</form>