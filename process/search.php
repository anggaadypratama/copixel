<?php

    $sc = isset($_GET['search']) ? $_GET['search'] : '';
    header("location: /?search=$sc");