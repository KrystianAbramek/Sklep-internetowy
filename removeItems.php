<?php

    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

    $removedOrNot = 0;
    $remove_item_id = "";
    $remove_item_id_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        if(empty(trim($_POST["remove_item_id"]))){
            $remove_item_id_error = "Please enter a item id.";
        }  
        else{
            $remove_item_id = trim($_POST["remove_item_id"]);
        }

        if(empty($remove_item_id_error)){
            // Prepare query
            $query = "DELETE FROM product WHERE item_id=?";
            
            if($result = $mysqli->prepare($query)){
                $result->bind_param("i", $param_remove_item_id);
                
                $param_remove_item_id = $remove_item_id;

                if($result->execute()){
                    $removedOrNot = 1;
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

    if($removedOrNot == 1){ 
        ?>
        <h1 style="text-align: center;">ADMIN PANEL</h1>
            <div class="addedNewItem">
                <h2><br><br><br><br>Product has been successfully removed from the store</h2>
                <br><input type="submit" class="btn btn-success font-size-18" onClick="history.back();"  onClick="location.reload();" value="Back">
            </div> 
        <?php
    }
    else
    {
        include('./Template/_removeItems.php');
    }

    // include footer.php file
    include ('footer.php');
?>