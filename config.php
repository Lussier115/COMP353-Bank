<?php
    define('DB_SERVER', '127.0.0.1');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'admin12345');
    define('DB_DATABASE', 'mec353_2');


    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    Echo mysqli_connect_error();
?>