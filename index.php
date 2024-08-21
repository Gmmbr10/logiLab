<?php

if ( filter_input(INPUT_GET,"url",FILTER_DEFAULT) == null ) {
    header("location: home");
}

require_once __DIR__ . "/public/index.php";