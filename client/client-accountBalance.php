<?php
session_start();

include('../config.php');


$current_client_id = $_SESSION['client_id'];
$current_profile = $_SESSION['profile_type'];
echo "current_client_id: " . $current_client_id;
echo "  current profile: " . $current_profile;
$sql = "SELECT DISTINCT interest_rate.kind_of_service, account.balance, interest_rate.type_of_account FROM interest_rate, account WHERE account.client_id = ($current_client_id) AND interest_rate.interest_rate_id = account.interest_rate_id  ";

// AND interest_rate.type_of_account = ($current_profile)";
$result = mysqli_query($db, $sql);


//    if ($result->num_rows > 0){
//        // output data of each row
//        echo nl2br("\r\n ");
//
//        echo "Account       Balance";
//        while($row = $result->fetch_assoc()) {
//
//            echo nl2br("\r\n ");
//            echo  $row["kind_of_service"]. ": ". $row["balance"]. "  type of account:  ".$row["type_of_account"];
//        }
//    } else {
//        echo nl2br("\r\n ");
//        echo "No Accounts to show";
//    }




//    echo "<table>"; // start a table tag in the HTML
//
//        if ($result->num_rows > 0) {
//            // output data of each row
//            echo nl2br("\r\n ");
//
//            echo "Account       Balance";
//            while ($row = $result->fetch_assoc()) {
//
//                echo nl2br("\r\n ");
//              //  echo $row["kind_of_service"] . ": " . $row["balance"] . "  type of account:  " . $row["type_of_account"];
//                echo "<tr><td>" . $row['kind_of_service'] . "</td><td>" . $row['balance'] . "</td><td>" . $row['type_of_account']. "</td></tr>";
//
//            }
//        } else {
//            echo nl2br("\r\n ");
//            echo "No Accounts to show";
//
//        }
//echo "</table>"; //Close the table in HTML
//
//?>


<!DOCTYPE html>
<html>
    <head>
        <?php include("../includes/head-tag-contents.php"); ?>
    </head>
    <body>
        <?php include("../includes/header.php");?>
        <div style="padding-left: 50px">
        <h1 >Account Balance</h1>


      <?php
       echo "<table border='' style='width: 25%'>"; // start a table tag in the HTML
       echo "<tr> <th>ACCOUNT</th><th>BALANCE</th></tr>" ;

        if ($result->num_rows > 0) {
            // output data of each row

            while ($row = $result->fetch_assoc()) {

                echo nl2br("\r\n ");
              //  echo $row["kind_of_service"] . ": " . $row["balance"] . "  type of account:  " . $row["type_of_account"];
                echo "<tr><td>" . $row['kind_of_service'] . "</td><td>" . $row['balance']."$". "</td></tr>";

            }
        } else {
            echo nl2br("\r\n ");
            echo "No Accounts to show";

        }
        echo "</table>"; //Close the table in HTML
      ?>


        </div>
        <?php include("../includes/footer.php");?>

    </body>


</html>
