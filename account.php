<?php include('session.php')?>
<?php
session_start();

    if (isset($_SESSION['session_token'])) {
        if ($_SESSION['account'] == 'client') {
            header("location: ../client/client-home.php");
        }

        if ($_SESSION['account'] == 'employee') {
            header("location: ../employee/employee-home.php");
        }
    }
?>