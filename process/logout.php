<?php

setcookie('token','',time() - 3600,'/');
header('location: /copixel');