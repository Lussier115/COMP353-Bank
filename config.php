<?php
define('DB_SERVER', 'mec353.encs.concordia.ca');
define('DB_USERNAME', 'mec353_2');
define('DB_PASSWORD', '11compdb');
define('DB_DATABASE', 'mec353_2');


    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    Echo mysqli_connect_error();
?>
