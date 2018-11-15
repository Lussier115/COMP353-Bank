<?php
/**
 * Created by PhpStorm.
 * User: carl
 * Date: 2018-11-15
 * Time: 5:26 PM
 */
session_start();

include('../config.php');


if(isset($_POST['account_type'])){
    //Checkbox has been ticked.
    // on click change value of SESSION[profile_type]="business" or "Personal"
    if ($SESSION[profile_type]=="Business"){
        $SESSION[profile_type]="Personal";
    }else{
        $SESSION[profile_type]="Business";
    }
}

?>