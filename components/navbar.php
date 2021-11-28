<?php
    include 'utilities/cookiesData.php';

?>


<div class="navbar_section">
    <div class="search-icon">
        <div class="logo">
            <a href="/copixel">
                COPIXEL
            </a>
        </div>
        <form>
            <div class="search-wrapper">
                <input type="text" placeholder="Cari gambar...">
                <button type="submit">
                    <div class="fa fa-search"></div>
                </button>
            </div>
        </form>
    </div>

    <div class="upload-auth">
        <a href="?p=upload" class="btn btn-primary px-3 py-2 btn-upload">Upload</a>
        <div class="dropdown">
            <img class="image-profile" src="https://www.anime-planet.com/images/characters/205377.jpg?t=1631194908"
                height="50" width="50" alt="profile" id="dropdownProfile" data-bs-toggle="dropdown"
                aria-expanded="false">

            <ul class="dropdown-menu mt-3" aria-labelledby="dropdownProfile">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                <li><a class="dropdown-item" href="process/logout.php">Keluar</a></li>
            </ul>
        </div>
    </div>

</div>