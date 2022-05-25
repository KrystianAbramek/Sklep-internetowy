<?php

    session_start();

    if(isset($_SESSION["root_session"]) && $_SESSION["root_session"] === true){
        header("location: root_panel.php");
        exit;
    }

    if(isset($_SESSION["admin_session"]) && $_SESSION["admin_session"] === true){
        header("location: admin_panel.php");
        exit;
    }


    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

    $username = $password = $confirm_password = "";
    $username_error = $password_error = $confirm_password_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_error = "Please enter username.";
        } 
        else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_error = "Please enter your password.";
        } 
        else{
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if(empty($username_error) && empty($password_error)){

            $query = "SELECT user_id, username, password, role FROM users WHERE username = ?";
            
            if($result = $mysqli->prepare($query)){

                $result->bind_param("s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                if($result->execute()){

                    $result->store_result();
                    

                    if($result->num_rows == 1){                    
                        $result->bind_result($id, $username, $hashed_password, $role);

                        if($result->fetch()){

                            if(password_verify($password, $hashed_password)){
                                if($role == 'root'){

                                    session_start();

                                    $_SESSION["root_session"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;                            

                                    header("location: root_panel.php");

                                }                            
                                elseif($role == 'admin'){       
                                    
                                    session_start();

                                    $_SESSION["admin_session"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;   

                                    header("location: admin_panel.php");

                                }
                                elseif($role == 'customer'){
                                    header("location: index.php");

                                }
                                else{
                                    $login_error = "Oops! Something went wrong. Please try again later.";

                                }
                                
                            } 
                            else{
                                $login_error = "Invalid username or password.";

                            }
                        }
                    } else{
                        $login_error = "Invalid username or password.";

                    }
                } else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $result->close();
            }
    }
    
    // Close connection
    $mysqli->close();
    }

?>

<?php
    ob_start();
    // include header.php file
    include ('header.php');
?>

    <div class="login">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_error)){
            echo '<div class="alert alert-danger">' . $login_error . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_error; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success font-size-18" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
<?php
// include footer.php file
include ('footer.php');
?>