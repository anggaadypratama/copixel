<?php

setcookie('token','',time() - 3600,'/');
        echo "<script type=\"text/javascript\">
        window.location.replace('/copixel')
        </script>";
exit();