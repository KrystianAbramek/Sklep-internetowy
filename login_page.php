<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>
    <div id="login">
    <form action="Login.php" method="post">
        <hr>
        <h2>Login</h2>
        <hr>
        Email: <input type="text" name="email_address" size="50"><br><br>
        Password: <input type="text" name="password"><br><br>
        <button type="submit" name="register_new_user" class="btn btn-success font-size-18">Log in</button>
        <hr>
        <a href="register_page.php">You do not have an account? Register</a>
        <hr>
    </form>
    </div>
<?php
    // include footer.php file
    include ('footer.php');
?>