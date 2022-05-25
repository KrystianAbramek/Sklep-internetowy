<?php

    session_start();
    
    if(!isset($_SESSION["root_session"]) || $_SESSION["root_session"] !== true){
        header("location: login.php");
        exit;
    }

    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

    $first_name = $last_name = $password = $confirm_password = "";
    $first_name_error = $last_name_error = $password_error = $confirm_password_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Validate first name
        if(empty(trim($_POST["first_name"]))){
            $first_name_error = "Please enter a first name.";
        }  
        else{
            $first_name = trim($_POST["first_name"]);
        }

        // Validate last name
        if(empty(trim($_POST["last_name"]))){
            $last_name_error = "Please enter a last name.";
        }  
        else{
            $last_name = trim($_POST["last_name"]);
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
        } 
        else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_error) && ($password != $confirm_password)){
                $confirm_password_error = "Password did not match.";
            }
        }

        if(empty($first_name_error) && empty($last_name_error) && empty($password_error) && empty($confirm_password_error)){

            // Prepare query
            $query = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";

            // create unique username
            $result = $mysqli -> query($query);
            while ($rows = $result->fetch_array()){
                $last_id = $rows['user_id'];
            }

            $last_id += 1;
            $random_number = rand(10,99);
            $username = $first_name . "_" . $last_name . $last_id . $random_number;

            // Prepare query
            $query = "INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')";
            
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
    <h1 style="text-align: center;">ROOT PANEL</h1>
    <div class="logout"><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a></div>
    <div class="register">
        <h2>Sign Up Admin Account </h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First name</label>
                <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                <span class="invalid-feedback"><?php echo $first_name_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Last name</label>
                <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
                <span class="invalid-feedback"><?php echo $last_name_error; ?></span>
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
        </form>
    </div>
<?php
// include footer.php file
include ('footer.php');
?>