<?php
/**
 * Created by PhpStorm.
 * User: carl
 * Date: 2018-11-23
 * Time: 1:55 PM
 */


//Bank profit= this year balance- last year balance
//balance = debit-credit balance of all accounts
session_start();
include('../config.php');
include('../session.php');

$sqlProfit = "SELECT DISTINCT account.balance, interest_rate.kind_of_service FROM interest_rate, account WHERE account.interest_rate_id = interest_rate.interest_rate_id AND (interest_rate.kind_of_service= 'checking' OR interest_rate.kind_of_service= 'saving' )";
$resultProfit = mysqli_query($db, $sqlProfit);
$sqlPSum = "SELECT SUM( account.balance) as totalProfit FROM interest_rate, account WHERE account.interest_rate_id = interest_rate.interest_rate_id AND (interest_rate.kind_of_service= 'checking' OR interest_rate.kind_of_service= 'saving' )";
$resultPSum = mysqli_query($db, $sqlPSum);

$sqlLoss = "SELECT DISTINCT account.balance, interest_rate.kind_of_service FROM interest_rate, account WHERE account.interest_rate_id = interest_rate.interest_rate_id AND (interest_rate.kind_of_service= 'credit' OR interest_rate.kind_of_service= 'credit_line' )";
$resultLoss = mysqli_query($db, $sqlLoss);
$sqlLSum = "SELECT SUM( account.balance) as totalLoss FROM interest_rate, account WHERE account.interest_rate_id = interest_rate.interest_rate_id AND (interest_rate.kind_of_service= 'credit' OR interest_rate.kind_of_service= 'credit_line' )";
$resultLSum = mysqli_query($db, $sqlLSum);


?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("../includes/head-tag-contents.php"); ?>
    </head>
    <body>

        <?php include("../includes/header.php"); ?>
        <?php include("employee-nav.php"); ?>

        <div class="container" id="main-content">
            <h2>Annual Profit and Losses </h2>

<!--    ---------TABLE OF PROFITS------------>
            <?php
            echo "<table border='' style='width: 25%'>";
            echo "<tr> <th>PROFIT</th><th>TYPE</th></tr>";

            if ($resultProfit->num_rows > 0) {
                // output data of each row

                while ($row = $resultProfit->fetch_assoc()) {
//                    echo nl2br("\r\n ");
                    //  echo $row["kind_of_service"] . ": " . $row["balance"] . "  type of account:  " . $row["type_of_account"];
                    echo "<tr><td>" . $row['balance'] . "$" . "</td><td>" . $row['kind_of_service'] . "</td></tr>";

                }
            } else {
                echo nl2br("\r\n ");
                echo "<tr><td>" ."0.00" . "$" . "</td></tr>";


            }

            if ($resultPSum->num_rows > 0) {
                while ($row = $resultPSum->fetch_assoc()) {
                    echo nl2br("\r\n ");
                    echo "<tr><th>"."total profit  "."</th><th>" ."+". $row['totalProfit'] . "$" . "</th></tr>";
                }
            }
            echo "</table>";
            ?>
<!--    ---------TABLE OF LOSSES------------>
            <?php
            echo "<table border='' style='width: 25%'>";
            echo "<tr> <th>LOSSES</th><th>TYPE</th></tr>";

            if ($resultLoss->num_rows > 0) {
                // output data of each row

                while ($row = $resultLoss->fetch_assoc()) {
//                    echo nl2br("\r\n ");
                    //  echo $row["kind_of_service"] . ": " . $row["balance"] . "  type of account:  " . $row["type_of_account"];
                    echo "<tr><td>" .$row['balance'] . "$" . "</td><td>" . $row['kind_of_service'] . "</td></tr>";

                }
            } else {
                echo nl2br("\r\n ");
                echo "<tr><td>" ."0.00" . "$" . "</td></tr>";


            }

            if ($resultLSum->num_rows > 0) {
                while ($row = $resultLSum->fetch_assoc()) {
                    echo nl2br("\r\n ");
                    echo "<tr><th>"."total loss  "."</th><th>" . "-".$row['totalLoss'] . "$" . "</th></tr>";
                }
            }
            echo "</table>";
            ?>






        </div>
        
        <?php include("../includes/footer.php"); ?>

    </body>
</html>