<?php
session_start();

include('../config.php');


    if ($_SESSION[profile_type]=="business"){
        $_SESSION[profile_type]="personal";
    }elseif($_SESSION[profile_type]=="personal"){
        $_SESSION[profile_type]="business";
    }



?>

