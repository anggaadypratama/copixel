<?php
    include '/utilities/db.php';

    $cookiesData = getCookiesData();
    $auth = (boolean)$cookiesData[0];

    $db = new DB();

    $uid = $_GET['uid'];

    $db->select('Users','*',"WHERE id_users='$uid'");
    $res = $db->sql;
    $resVal = $res->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data" action="process/edit-profile.php" x-data="{edit: true}"
    class="edit-profile-form">
    <div class="image-profile">
        <label for="img-profile">
            <img src="<?= $resVal['img_profile']?>" id="profile-img" alt="img-profile">
            <div class="overlay" x-bind:class="edit? 'disabled' : ''">
                <p> Ganti <br>Gambar</p>
            </div>

        </label>
        <input type="file" accept="image/png, image/jpg, image/jpeg" name="img-profile" id="img-profile"
            x-bind:disabled="edit">

    </div>
    <div class="user-form">
        <input class="user-form__name <?= $uid !== $cookiesData[1] ? 'user' : '' ?>" type="text" name="name"
            placeholder="Tidak Boleh Kosong" value="<?= ucwords($resVal['name']) ?>" maxlength="20"
            x-bind:disabled="edit">
        <input class="user-form__desc mt-2" type="text" name="about"
            placeholder="<?= $auth && ($uid === $cookiesData[1]) ? 'Isi tentang kamu' : ''?>"
            value="<?= $resVal['about'] ?>" maxlength="50" x-bind:disabled="edit">
        <?php if($auth && $uid === $cookiesData[1]){
            echo <<<STR
                <div class="edit-button mt-4">
                    <button class="btn rounded btn-outline-secondary btn-sm" x-on:click="edit = !edit"
                        onclick="event.preventDefault(); reset()">
                        Edit Profile
                    </button>
                    <input x-show="!edit" class="btn rounded btn-primary btn-sm mx-2" name="submit" type="submit" value="Simpan">
                </div>
            STR;
        }
        ?>

    </div>
</form>