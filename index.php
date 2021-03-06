<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copixel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' rel='stylesheet'
        type='text/css'>

    <link href="./style/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>


    <?php

        $p=isset($_GET['p'])?$_GET['p']:'';
        $pages_dir='pages';

        if(!empty($_GET['p'])){
            $pages=scandir($pages_dir,0);
            unset($pages[0],$pages[1]);

            if(in_array($p.'.php',$pages)){
                if($p !== "auth") include "components/navbar.php";

                include($pages_dir.'/'.$p.'.php');
                // if($p !== "auth") include "components/footer.php";
                if($p !== "auth") echo '<div class="mt-5"></div>';
            }else{
                echo'Halaman Tidak Ditemukan';
            }
        }else{
            include "components/navbar.php";
            include($pages_dir.'/home.php');
            // include "components/footer.php";
            echo '<div class="mt-4"></div>';
        }
    ?>



    <!-- <div id="overlay"></div> -->
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    <script type="module" src="./script/post.js"></script>
    <!-- <script src="./script/upload.js"></script>
    <script src="./script/uploadEdit.js"></script> -->
    <script type="module" src="./script/profile.js"></script>
    <script src="./script/comment.js"></script>
    <script src="./script/pagination.js"></script>
    <script type="module" src="./script/validation.js"></script>
    <script src="./script/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>