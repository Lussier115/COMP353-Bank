<form  style=" background-color: rgba(255, 255, 255, 0.5);" action = "" method = "post" class = "form-box" id="account">
    <h3>For Employees</h3>
    <label>Email  :</label><input class="form-control2" type = "email_address" name = "email_address" class = "box"/><br /><br />
    <label>Password  :</label><input class="form-control2" type = "password" name = "password" class = "box" /><br/><br/>
    <label>First Name  :</label><input class="form-control2" type = "text" name = "first_name" class = "box"/><br /><br />
    <label>Last Name  :</label><input class="form-control2" type = "text" name = "last_name" class = "box"/><br /><br />
    <label>Title  :</label><input class="form-control2" type = "text" name = "title" class = "box"/><br /><br />
    <label>Phone Number :</label><input  class="form-control2" type = "tel" name = "phone" class = "box"/><br /><br />
    <label>Start Date  :</label><input  class="form-control2" type = "date" name = "start_date" class = "box"/><br /><br />
    <label>Address :</label><input  class="form-control2" type = "text" name = "address" class = "box"/><br /><br />
    <label>Salary  :</label><input   class="form-control2" type = "number" name = "salary" class = "box"/><br /><br />
    <label>Bank Location :</label><?php include('bank-selection.php')?>
    <label>isAdmin  :</label><input type = "checkbox" name = "is_admin" class = "box" /><br/><br/>
    <input type="hidden" name="action" value="employee">
    <input type = "submit" value = " Submit "/><br />
</form>