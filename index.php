<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'
        type='text/css'>
</head>

<body>
    <script src="//unpkg.com/alpinejs" defer></script>

    <?php
        $p=$_GET['p'];
        $pages_dir='pages';

        if(!empty($_GET['p'])){
            $pages=scandir($pages_dir,0);
            unset($pages[0],$pages[1]);

            if(in_array($p.'.php',$pages)){
                if($p !== "auth") include "components/navbar.php";

                include($pages_dir.'/'.$p.'.php');

            }else{
                echo'Halaman Tidak Ditemukan';
            }
        }else{
            include "components/navbar.php";
            include($pages_dir.'/home.php');
        }
    ?>

    <div id="overlay"></div>


    <script type="module" src="./script/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>