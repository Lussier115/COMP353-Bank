<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 11/11/18
 * Time: 3:46 PM
 */

   session_start();

   if(!isset($_SESSION['session_token'])){
       header("location: ../authentication/login.php");
   }
?>