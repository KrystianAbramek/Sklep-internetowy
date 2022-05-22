<?php

    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

    $username = $password = $confirm_password = "";
    $username_error = $password_error = $confirm_password_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_error = "Please enter a username.";
        }  
        else{
            $username = trim($_POST["username"]);
        }

        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_error = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 8){
            $password_error = "Password must have atleast 8 characters.";
        } else{
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_error = "Please confirm password.";     
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_error) && ($password != $confirm_password)){
                $confirm_password_error = "Password did not match.";
            }
        }

        if(empty($username_error) && empty($password_error) && empty($confirm_password_error)){
            
            // Prepare query
            $query = "INSERT INTO users (username, password) VALUES (?, ?)";
            
            if($result = $mysqli->prepare($query)){
                $result->bind_param("ss", $param_username, $param_password);
                
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                if($result->execute()){
                    header("location: login.php");
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                $result->close();
            }
        }
    }

?>

<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>
    <div class="register">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_error; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success font-size-18" value="Submit">
                <input type="reset" class="btn btn-danger font-size-18" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
<?php
// include footer.php file
include ('footer.php');
?>