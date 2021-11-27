<div class="home">
    <div class="banner">
        <div class="container banner__wrapper">
            <div class="desc">
                <p>Temukan Gambar Dan Bagikan Gambarmu Disini</p>
                <a href="?p=auth&s=register" class="btn btn-primary px-5 py-3 mt-3">Daftar</a>
            </div>
            <img src="image/people.png" alt="orang">
        </div>
    </div>
    <div class="content">
        <!-- <ul class="tags-list mt-4">
            <li>
                <input type="radio" id="all" name="content_type" value="All" checked>
                <label for="all">All</label>
            </li>
            <?php 
                // $tags = array( "Branding", "Illustration", "UI Design", "Typograhpy", "Mobile Design", "Web Design");

                // foreach ($tags as $value) {
                //     echo <<<STR
                //         <li>
                //             <input type="radio" id="$value" name="content_type" value="$value">
                //             <label for="$value">$value</label>
                //         </li>
                //     STR;
                // }
            ?>
        </ul> -->
        <div class="container mt-4 mb-4">
            <div class="row">

                <?php
                        for($i = 0; $i < 10; $i ++){
                            echo <<<STR
                            <div class="col-lg-4 col-xl-3 col-12 col-md-6 my-2">
                                <div class="card">
                                        <a href="/copixel?p=detail-post" class="image-wrapper">
                                        <div class="image-overlay">
                                            <div class="mx-3">
                                                <p>Dashboard Ui</p>
                                            </div>
                                        </div>
                                        <img class="image-card" loading=”lazy” src="https://images6.alphacoders.com/115/1154953.jpg" alt="">
                                    </a>
                                    <div class="post-info mt-3">
                                        <a href="/copixel?p=profile" class="account">
                                            <img
                                                loading=”lazy”
                                                src="https://www.anime-planet.com/images/characters/205377.jpg?t=1631194908" 
                                                alt=""
                                                height="24"
                                                width="24"
                                                style="object-fit: cover; border-radius: 50%"
                                            >
                                            <p>Udin Jaenudin</p>
                                        </a>
                                            <label>
                                                <input type="checkbox">
                                                <span class="label">&#x2665;</span>
                                            </label>
                                    </div>
                                </div>
                            </div>
                            STR;
                        }
                    ?>

            </div>
        </div>
    </div>
</div>