<?php
    /**
     * Created by PhpStorm.
     * User: william
     * Date: 14/11/18
     * Time: 9:36 PM
     */

    include('../config.php');

    $sql = "SELECT client_id, first_name, last_name FROM mec353_2.client";
    $result = mysqli_query($db, $sql);
?>

<select name="chosen_client" form="payroll" class="form-control">
    <?php while ($row = mysqli_fetch_array($result)):; ?>
		<option value=<?php echo $row[0]; ?>><?php echo "$row[1] $row[2]"; ?></option>
    <?php endwhile; ?>
</select>
<br>
<br>