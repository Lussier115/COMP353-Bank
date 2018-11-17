<?php
    /**
     * Created by PhpStorm.
     * User: william
     * Date: 14/11/18
     * Time: 9:36 PM
     */

    include('../config.php');

    $sql = "SELECT branch_id, location FROM mec353_2.branch";
    $result = mysqli_query($db, $sql);
?>

<select name="bank_location" form="account">
    <?php while ($row = mysqli_fetch_array($result)):; ?>
		<option value=<?php echo $row[0]; ?>><?php echo $row[1]; ?></option>
    <?php endwhile; ?>
</select>
<br>
<br>