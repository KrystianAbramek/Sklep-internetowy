<?php

    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

    $editedOrNot = 0;
    $item_id = $item_brand = $item_name = $item_price = $item_image = $item_destiny = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        $item_id = trim($_POST["item_id"]);

        $item_brand = trim($_POST["item_brand"]);

        $item_name = trim($_POST["item_name"]);

        $item_price = trim($_POST["item_price"]);

        $item_image = trim($_POST["item_image"]);

        $item_destiny = trim($_POST["item_destiny"]);



        if(!empty($item_id) && !empty($item_brand) && !empty($item_name) && !empty($item_price) && !empty($item_image) && !empty($item_destiny)){

            // Prepare query
            $query = "UPDATE product SET item_brand = ?, item_name = ?, item_price = ?, item_image = ?, item_destination = ? WHERE item_id = ?";
            
            if($result = $mysqli->prepare($query)){
                $result->bind_param("ssdssi", $param_item_brand, $param_item_name, $param_item_price, $param_item_image, $param_item_destiny, $param_item_id);
                
                // Set parameters
                $param_item_brand = $item_brand;
                $param_item_name =  $item_name;
                $param_item_price = $item_price;
                $param_item_image = $item_image;
                $param_item_destiny = $item_destiny;
                $param_item_id = $item_id;


                if($result->execute()){
                    $editedOrNot = 1;
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                $result->close();
            }

        }
        else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

?>

<?php
    ob_start();
    // include header.php file
    include ('header.php');

    if($editedOrNot == 1){ 
        ?>
        <h1 style="text-align: center;">ADMIN PANEL</h1>
            <div class="addedNewItem">
                <h2><br><br><br><br>Product parameters has been successfully changed</h2>
                <br><input type="submit" class="btn btn-success font-size-18" onClick="history.back();" value="Back">
            </div> 
        <?php
    }
    else
    {
        include('./Template/_itemList.php');
    }

    // include footer.php file
    include ('footer.php');
?>