<?php include('../../session.php')?>

<?php 
    include("../../config.php");
    $client_id = $_SESSION['client_id'];
    $transfer_success = false;
    $transfer_error = false;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['action'] == "pay_now"){
            $to_pay = 0;
            if($_POST['credit_card']){$to_pay += 20;}
            if($_POST['house']){$to_pay += 1000;}
            if($_POST['car']){$to_pay += 150;}
            $from_account_id = $_POST['from_account'];

            $sql = "SELECT balance FROM Account WHERE account_id = $from_account_id AND client_id = $client_id";
            $result = mysqli_query($db,$sql);
            $account_balance  = mysqli_fetch_array($result)['balance'];

            print("THIS IS THE ACCOUNT BALANCE CHOSEN");
            print($account_balance);
            if($account_balance > $to_pay){
                $new_balance = $account_balance - $to_pay;
                mysqli_query($db, "UPDATE Account SET balance = $new_balance WHERE account_id = $from_account_id AND client_id = $client_id");
                $transfer_success = true;
            }else{
                #ERROR: not enough money
                $transfer_error = true;
            }
        }else{
            #handle future payments
        }
    }else{
        $sql = "SELECT account_id FROM Account WHERE client_id = $client_id";
        $result = mysqli_query($db,$sql);
        $account_ids = []; 
        #takes the sql querry results and puts it into an array
        while(($row = mysqli_fetch_array($result))) {
            #$account_ids.push($row);
            array_push($account_ids,$row['account_id']);
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
	<?php include("../../includes/head-tag-contents.php");?>
</head>
<body>

<?php include("../../includes/header.php");?>
<?php include("../client-nav.php");?>


<div class="container" id="main-content">
    <?php if(!$transfer_success) : ?>
	<h2>Future Payments</h2>
    <form action = "" method = "post">
        <h3>Bills to Pay</h3>
        <input type="checkbox" name="credit_card" value="true">Credit Card: 20$<br>
        <input type="checkbox" name="house" value="true">House: 1000$<br>
        <input type="checkbox" name="car" value="true">Car: 150$<br>
        <input type="hidden" name="action" value="pay_now">
        <br>
        Pay from which account
        <select name = "from_account">
            <?php foreach($account_ids as $account_id): ?>
                <option value = "<?php echo $account_id;?>"><?php echo $account_id; ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type = "submit">Pay Now</button>
    </form>

    <form action = "" method = "post">
        <h2>Setup Future recorcuring payments</h2>
        <input type="checkbox" name="house" value="house">House: 1000$<br>
        <input type="checkbox" name="car" value="car">Car: 150$<br>
        <input type="hidden" name="action" value="pay_future">
        <button type = "submit">Pay Monthly</button>
    </form>
    <?php elseif($transfer_error) : ?>
        <h1>Error Paying Bills</h1>
    <?php else : ?>
        <h1>Bills Successfully Paid!</h1>
    <?php endif; ?>
</div>

<?php include("../../includes/footer.php");?>

</body>
</html>