<?php include('../../session.php')?>

<?php 
    include("../../config.php");
    $money_transfer_success = false;
    $is_error = false;
    $client_id = $_SESSION['client_id'];
    //form
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $transfer_amount = $_POST['transfer_amount'];
        $from_account = $_POST['from_account'];
        $to_account = $_POST['to_account'];

        $sql = "SELECT balance FROM Account WHERE account_id = $from_account AND client_id = $client_id";
        $result = mysqli_query($db,$sql);
        $amount_in_from_account = mysqli_fetch_array($result)['balance'];
        if($amount_in_from_account > $transfer_amount){
            //remove x amount in 'from_account'
            $from_account_new_balance = $amount_in_from_account - $transfer_amount;
            mysqli_query($db, "UPDATE Account SET balance = $from_account_new_balance WHERE account_id = $from_account AND client_id = $client_id");
            
            //add x amount in 'to_account
            $sql = "SELECT balance FROM Account WHERE account_id = $from_account AND client_id = $client_id";
            $result = mysqli_query($db,$sql);
            $amount_in_to_account = mysqli_fetch_array($result)['balance'];
            $to_account_new_balance = $amount_in_to_account + $transfer_amount;
            mysqli_query($db,"UPDATE Account SET balance = $to_account_new_balance WHERE account_id = $to_account AND client_id = $client_id");
            $money_transfer_success = true;
        }else{
            $is_error = true;
        }
    }else{
        $sql = "SELECT account_id FROM Account WHERE client_id = $client_id";
        $result = mysqli_query($db,$sql);
        $account_ids = []; 

        #takes the sql querry results and puts it into an arrow
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
<style>
    .transfer-money-holder{
        display: flex;
    }
</style>
<body>

<?php include("../../includes/header.php");?>
<?php include("../client-nav.php");?>

<?php if(!$money_transfer_success) : ?>
<div class="container" id="main-content">
	<h2>Transfer Money</h2>

    <form action = "" method = "post">
        <div>
            <div>Amount</div>
            <input type = "number" name = "transfer_amount">
        </div>
        <div class = "transfer-money-holder">
            <div>
                <h3>From</h3>
                <select name = "from_account">
                    <?php foreach($account_ids as $account_id): ?>
                        <option value = "<?php echo $account_id;?>"><?php echo $account_id; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <h3>To</h3>
                <select name = "to_account">
                    <?php foreach($account_ids as $account_id): ?>
                        <option value = "<?php echo $account_id;?>"><?php echo $account_id; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type = "submit">Transfer</button>
    </form>
</div>
<?php elseif($is_error) : ?>
    <h1>Error Transfering Money</h1>
<?php else : ?>
    <h1>Money Transfer Success!</h1>
<?php endif; ?>

<?php include("../../includes/footer.php");?>

</body>
</html>