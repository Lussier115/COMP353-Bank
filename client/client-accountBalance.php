<?php
session_start();

    include('../config.php');


    //add selection criteria of type of account (buisness/personnal)
    $current_client_id= $_SESSION['client_id'] ;
    echo "current_client_id: ".$current_client_id;
    $sql = "SELECT DISTINCT interest_rate.kind_of_service, account.balance, account.client_id FROM interest_rate, account WHERE account.client_id = ($current_client_id) AND interest_rate.interest_rate_id = account.interest_rate_id";
    $result = mysqli_query($db,$sql);

    if ($result->num_rows > 0){
        // output data of each row
        echo "Account       Balance";
        while($row = $result->fetch_assoc()) {

            echo nl2br("\r\n ");
            echo  $row["kind_of_service"]. ": ". $row["balance"]. "  ID: ".$row["client_id"];
        }
    } else {
        echo "No Accounts to show";
    }



?>


<!DOCTYPE html>
<html>
    <head>
        <?php include("../includes/head-tag-contents.php"); ?>
    </head>
    <body>
        <?php include("../includes/header.php");?>



        <?php include("../includes/footer.php");?>

    </body>


</html>
