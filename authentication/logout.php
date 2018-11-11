<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 11/11/18
 * Time: 5:05 PM
 */

   session_start();

   if(session_destroy()) {
       header("Location: ../authentication/login.php");
   }
?>