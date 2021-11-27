<div class="profile">
    <div class="container">
        <div class="identity">
            <?php include "components/edit-profile.php"; ?>
        </div>
        <div class="content mt-4">
            <div class="row">
                <?php
                    for($i = 0; $i < 10; $i ++){
                        echo <<<STR
                            <div class="col-3 my-2">
                                <div class="card">
                                        <a href="/#" class="image-wrapper">
                                        <div class="image-overlay">
                                            <div class="mx-3">
                                                <p>Dashboard Ui</p>
                                            </div>
                                        </div>
                                        <img class="image-card" loading=”lazy” src="https://images6.alphacoders.com/115/1154953.jpg" alt="">
                                    </a>
                                    <div class="post-info mt-3">
                                        <a href="/#" class="account">
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