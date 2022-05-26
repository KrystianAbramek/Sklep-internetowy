<?php
    session_start();
        
    if(!isset($_SESSION["admin_session"]) || $_SESSION["admin_session"] !== true){
        header("location: login.php");
        exit;
    }

    ob_start();
    // include header.php file
    include ('header.php');
?>
    <div class="logout">
        <br><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </div>
    <br><br><br><br>
    <h1 style="text-align: center;">ADMIN PANEL</h1>
    <br><br><br>
    <div class="adminPanel">
        <a href="addNewItems.php" class="btn btn-outline-dark ml-3 addItemsButton">Add new product</a>
    </div>
    <div class="adminPanel">
        <a href="editItems.php" class="btn btn-outline-primary ml-3 editItemsButton">Edit product parameters</a>
    </div>
    <div class="adminPanel">
        <a href="removeItems.php" class="btn btn-outline-success ml-3 removeItemsButton">Remove products</a>
    </div>

<?php
    // include footer.php file
    include ('footer.php');
?>