<?php include('../../session.php')?>

<?php 
    include("../../config.php");
    $money_transfer_success = false;
    $not_enough_funds = false;
    $negative_transfer_amount = false;
    $is_phone_empty = false;
    $is_email_empty = false;
    $is_email_phone_empty = false;
    $is_email_phone_different_client = false;
    $is_recipient_client_id_empty = false;
    $transfer_client_id = null;
    $transfer_client_id2 = null;
    $client_id = $_SESSION['client_id'];
    #print(' Id of Client: ');
    #print($client_id);

    //form
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    $transfer_amount = $_POST['transfer_amount'];
    #print(' transfer_amount: ');
    #print($transfer_amount);

    if($transfer_amount < 0 )
    {
        #print("Amount entered is negative");
        $negative_transfer_amount = true;
    }

    $from_account = $_POST['from_account'];
    #print(' from_account: ');
    #print($from_account);

    $email = $_POST['email'];
    #print(' email: ');
    #print($email);
    if ($email == ""){
        #print("email is empty   ");
        $is_email_empty = true;
    }

    $phone = $_POST['phone'];
    #print(' phone: ');
    #print($phone);
    if ($phone == ""){
        #print("phone is empty   ");
        $is_phone_empty = true;
    }
    
    if ($email == "" & $phone == ""){
        #print("email and phone are empty");
        $is_email_phone_empty = true;
    }

    $sql = "SELECT balance FROM mec353_2.account WHERE account_id = $from_account AND client_id = $client_id";
    $result = mysqli_query($db,$sql);
    $amount_in_from_account = mysqli_fetch_array($result)['balance'];
    #print(' amount_in_from_account: ');
    #print($amount_in_from_account);

    if($amount_in_from_account > $transfer_amount && !$is_email_phone_empty && !$negative_transfer_amount){

        #Get the client_id for the provided email or/and the provided phone number
        $sql1 = "SELECT client_id FROM mec353_2.client WHERE email = '$email'"; 
        $sql2 = "SELECT client_id FROM mec353_2.client WHERE phone = '$phone'";
        $result1 = mysqli_query($db,$sql1);
        $result2 = mysqli_query($db,$sql2);

        if(!$is_email_empty ) {
            $transfer_client_id = mysqli_fetch_array($result1)['client_id'];
        }
        
        if(!$is_phone_empty) {
                $transfer_client_id2 = mysqli_fetch_array($result2)['client_id'];        
        }
            
            #Verify if client_id exist.
            if (($transfer_client_id == null && $transfer_client_id2 == null) || ($transfer_client_id == null && $transfer_client_id2 == "") || ($transfer_client_id == "" && $transfer_client_id2 == NULL) || ($transfer_client_id == "" && $transfer_client_id2 == ""))
            {
                #print('Recipient does not exist');
                $is_recipient_client_id_empty = true;
            }
            
             #Verify If client_id found through email & client_id found through phone number is different when user provides both. 
            elseif (($transfer_client_id != $transfer_client_id2) && (!$is_email_empty && !$is_phone_empty)) {
                #print(' Phone And Email belong to different Recipient OR Entered invalid phone/username');
                $is_email_phone_different_client = true;
            }
            
            else{
                
                if($transfer_client_id == null || $transfer_client_id == "" ) {
                    $transfer_client_id = $transfer_client_id2;
                }
                
                $sql = "SELECT balance FROM mec353_2.account WHERE client_id = $transfer_client_id";
                $result = mysqli_query($db,$sql);
                $amount_in_to_account = mysqli_fetch_array($result)['balance'];
                #print("amount_in_to_account ");
                #print($amount_in_to_account);

                //remove x amount in 'from_account' for client
                $from_account_new_balance = $amount_in_from_account - $transfer_amount;
                mysqli_query($db, "UPDATE mec353_2.account SET balance = $from_account_new_balance WHERE account_id = $from_account AND client_id = $client_id");
                #print(' from_account_new_balance: ');
                #print($from_account_new_balance);

                #Add x amount to first account (main account) of the recipient.
                $to_account_new_balance = $amount_in_to_account + $transfer_amount;
                #print("to_account_new_balance ");
                #print($to_account_new_balance);
                mysqli_query($db,"UPDATE mec353_2.account SET balance = $to_account_new_balance WHERE client_id = $transfer_client_id LIMIT 1");
                $money_transfer_success = true; 
            }
   
    }else{
        $not_enough_funds = true;
    }
}else{
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
    
    <?php elseif($negative_transfer_amount) : ?>
        <h2 style="text-align: center;">The Provided amount is negative</h2>

        <?php elseif($is_email_phone_empty) : ?>
            <h2 style="text-align: center;">No Email Address And Phone Address Provided</h2>

            <?php elseif($is_email_phone_different_client) : ?>
            <h2 style="text-align: center;"> Phone And Email belong to different Recipient OR Entered invalid phone/username</h2>
                
                <?php elseif($is_recipient_client_id_empty) : ?>
                <h2 style="text-align: center;">No Recipient Found With The Provided Information</h2>
                    
                    <?php elseif($not_enough_funds) : ?>
                    <h2 style="text-align: center;">Not Enough Money</h2>
                        
                        <?php else : ?>
                            <h2 style="text-align: center;">Money Transfer Success!</h2>
                        <?php endif; ?>
</div>

<?php include("../../includes/footer.php");?>

</body>