<form action = "" method = "post" class = "form-box" id="account">
    <h3>For Employees</h3>
    <label>Email  :</label><input type = "email_address" name = "email_address" class = "box"/><br /><br />
    <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
    <label>First Name  :</label><input type = "text" name = "first_name" class = "box"/><br /><br />
    <label>Last Name  :</label><input type = "text" name = "last_name" class = "box"/><br /><br />
    <label>Title  :</label><input type = "text" name = "title" class = "box"/><br /><br />
    <label>Phone Number :</label><input type = "tel" name = "phone" class = "box"/><br /><br />
    <label>Start Date  :</label><input type = "date" name = "start_date" class = "box"/><br /><br />
    <label>Address :</label><input type = "text" name = "address" class = "box"/><br /><br />
    <label>Salary  :</label><input type = "number" name = "salary" class = "box"/><br /><br />
    <label>Bank Location :</label><?php include('bank-selection.php')?>
    <label>isAdmin  :</label><input type = "checkbox" name = "is_admin" class = "box" /><br/><br/>
    <input type="hidden" name="action" value="employee">
    <input type = "submit" value = " Submit "/><br />
</form>