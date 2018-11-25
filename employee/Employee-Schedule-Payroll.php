<!DOCTYPE html>
<html>
<head>
    <?php include("../../includes/head-tag-contents.php");?>
    <link rel="stylesheet" type="text/css" href="../employee.css">
</head>
<body>

<?php include("../../includes/header.php");?>
<?php include("../employee-nav.php");?>

<div class="card"  id="">
    <div class="card-body">
    <form action="" method="post">
        <legend class="text-center">Employee Schedule, Payroll, Holidays & Sickdays </legend>
        <div class="form-group">
        <label for="work">Work Day Schedule</label>
        <input type="text" class="form-control" name="work" placeholder="Ex: Mon-Fri-8:00-16:00">
        </div>
        <div class="form-group">
        <label for="payroll">Monthly Payroll Day</label>
        <input type="text" class="form-control" name="payroll" placeholder="Ex: Last Friday of the month">
        </div>
        <div class="form-group">
        <label for="holidays">Holidays</label>
        <input type="text" class="form-control" name="holidays" placeholder="Ex: Aug 17 - Sept 12">
        </div>
        <div class="form-group">
        <label for="sickdays">Sickdays</label>
        <input type="text" class="form-control" name="sickdays" placeholder="Ex: Feb 13, May 9, May 10">
        </div>
        </select>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
    <div>
</div>

    <?php include("../../includes/footer.php");?>

</body>
</html>