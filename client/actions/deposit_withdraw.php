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
    
</div>

<?php include("../../includes/footer.php");?>

</body>
</html>