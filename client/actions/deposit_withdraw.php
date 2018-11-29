<?php include('../../session.php')?>

<?php 
    include("../../config.php");
    $money_transfer_success = false;
    $negative_transfer_amount = false;
    $zero_transfer_amount = false;
    $not_enough_funds = false;
    $deposit = false;
    $withdraw = false;
    $client_id = $_SESSION['client_id'];
    //form
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $transfer_amount = $_POST['transfer_amount'];
        $to_account = $_POST['to_account'];
        $transaction_type = $_POST['transaction_type'];

        if ($transaction_type == "deposit")
        {
            $deposit = true;
        }

        if ($transaction_type == "withdraw")
        {
            $withdraw = true;
        }

        if($transfer_amount < 0 )
        {
            #print("Amount entered is negative");
            $negative_transfer_amount = true;
        }

            elseif($transfer_amount == 0){
                $zero_transfer_amount = true;
            }
            
            else{
                #Retrieve Amount in account
                $sql = "SELECT balance FROM mec353_2.account WHERE account_id = $to_account AND client_id = $client_id";
                $result = mysqli_query($db,$sql);
                $amount_in_to_account = mysqli_fetch_array($result)['balance'];

                if(($amount_in_to_account < $transfer_amount) && $withdraw)
                {
                    $not_enough_funds = true;
                }
                else {
                    #remove amount from account
                    if($withdraw){
                        $to_account_new_balance = $amount_in_to_account - $transfer_amount;
                    }

                    #add amount to account
                    if($deposit) {
                        $to_account_new_balance = $amount_in_to_account + $transfer_amount;
                    }
                
                    mysqli_query($db,"UPDATE mec353_2.account SET balance = $to_account_new_balance WHERE account_id = $to_account AND client_id = $client_id");
                    $money_transfer_success = true;
                }
            }
    }
    else{
        $sql = "SELECT account_id, balance FROM mec353_2.account WHERE client_id = $client_id";
        $result = mysqli_query($db,$sql);
        while(($row = mysqli_fetch_array($result))) {
            $account_ids[] = $row;
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
    select{
        margin: 7px;
    }
    form{
        display: inline-block;
        text-align: center;
    }
    .form-containter{
        width: 100%;
        text-align: center;
    }
    h3{
        margin: 0;
    }
    #transaction{
        font-size: 20px;
        font-weight: bold;
    }
</style>
<body>

<?php include("../../includes/header.php");?>
<?php include("../client-nav.php");?>

<?php if(!$money_transfer_success && !$negative_transfer_amount && !$zero_transfer_amount) : ?>
<div class="container" id="main-content">
	<h2>Deposit/Withdraw</h2>
    <div class = "form-containter">
        <form action = "" method = "post">
            <div>
                <select name ="transaction_type" id= "transaction">
                    <option value="deposit">Deposit</option>
                    <option value="withdraw">Withdraw</option>
                </select>
            </div>
            <div>
                <p> </p>
                <h3>Amount</h3>
                <input type = "number" name = "transfer_amount">
                <p> </p>
            </div>
            <div>
                <div>
                    <h3>To Account</h3>
                    <select name = "to_account">
                        <?php foreach($account_ids as $account_id): ?>
                            <option value = "<?php echo $account_id[0];?>"><?php echo $account_id[0]; echo "(".$account_id[1]."$)" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <p> </p>
            <button type = "submit">Transfer</button>
        </form>
    </div>
    <?php elseif($negative_transfer_amount) : ?>
		<h2 style="text-align: center;">Invalid: You have entered a negative amount</h2>
        <?php elseif($zero_transfer_amount) : ?>
		    <h2 style="text-align: center;">Invalid: You have entered '0' as an amount</h2>
                <?php elseif($not_enough_funds) : ?>
                <h2 style="text-align: center;">Invalid: Not enough funds in accounnt to withdraw</h2>
                    <?php elseif($deposit) : ?>
                    <h2 style="text-align: center;">Deposit Success!</h2>
                        <?php elseif($withdraw) : ?>
                        <h2 style="text-align: center;">Withdraw Success!</h2>
                            <?php else : ?>
                                <h2 style="text-align: center;">Money Transfer Success!</h2>
                            <?php endif; ?>
</div>

<?php include("../../includes/footer.php");?>

</body>
</html>