<?php

setcookie('token','',time() - 3600,'/');
        echo "<script type=\"text/javascript\">
        window.location.replace('/')
        </script>";
exit();