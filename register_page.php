<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>
    <div id="login">
    <form action="Template/Register.php" method="post">
        <hr>
        <h2>Register Account</h2>
        <hr>
        Name: <input type="text" name="name">
        Surname: <input type="text" name="surname"><br><br>
        Email: <input type="text" name="email_address" size="50"><br><br>
        Password: <input type="text" name="password">
        Confirm your password: <input type="text" name="confirm_password"><br><br>
        Phone number: <input type="text" name="phone_number"> 
        Age: <input type="text" name="age"><br><br>
        <button type="submit" name="register_new_user" class="btn btn-success font-size-18">Register Your Account</button>
        <hr>
        <a href="login_page.php">Already have an account? Login</a>
        <hr>
    </form>
    </div>

<?php
    // include footer.php file
    include ('footer.php');
?>