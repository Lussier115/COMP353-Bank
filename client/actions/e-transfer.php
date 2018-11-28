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
    #amount{
        font-size: 15px;
    }
</style>

<body>

<?php include("../../includes/header.php");?>
<?php include("../client-nav.php");?>

<?php if(!$money_transfer_success && !$not_enough_funds & !$is_email_phone_empty & !$is_email_phone_different_client & !$is_recipient_client_id_empty & !$negative_transfer_amount) : ?>
<div class="container" id="main-content">
	<h2>E-Transfer</h2>

    <div class = "form-containter">
        <form action = "" method = "post">
            <div>
                <div id = "amount">Amount</div>
                <input type = "number" name = "transfer_amount" required>
            </div>
                <div>
                    <h3>From</h3>
                    <select name = "from_account">
                        <?php foreach($account_ids as $account_id): ?>
                            <option value = "<?php echo $account_id[0];?>"><?php echo $account_id[0]; echo "(".$account_id[1]."$)" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div>
                <h3>To</h3>
                <div id = "amount">Email Address</div>
                <input type = "text" name = "email">
            </div>
            <div>
                <div id = "amount">Cell Phone Number</div>
                <input type = "text" name = "phone">
            </div>
            <button type = "submit">Transfer</button>
        </form>
    </div>
    
 
</div>

<?php include("../../includes/footer.php");?>

</body>