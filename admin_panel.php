<?php

    session_start();
        
    if(!isset($_SESSION["admin_session"]) || $_SESSION["admin_session"] !== true){
        header("location: login.php");
        exit;
    }

    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

    $addOrNot = 0;
    $item_brand = $item_name = $item_price = $item_image = $item_destiny = "";
    $item_brand_error = $item_name_error = $item_price_error = $item_image_error = $item_destiny_error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        if(empty(trim($_POST["item_brand"]))){
            $item_brand_error = "Please enter a item brand.";
        }  
        else{
            $item_brand = trim($_POST["item_brand"]);
        }
        
        if(empty(trim($_POST["item_name"]))){
            $item_name_error = "Please enter a item name.";
        }  
        else{
            $item_name = trim($_POST["item_name"]);
        }

        if(empty(trim($_POST["item_price"]))){
            $item_price_error = "Please enter a item price.";
        }  
        else{
            $item_price = trim($_POST["item_price"]);
        }

        if(empty(trim($_POST["item_image"]))){
            $item_image_error = "Please enter a item image.";
        }  
        else{
            if(str_contains(trim($_POST["item_image"]), ".png")){
                $item_image = trim($_POST["item_image"]);
            }
            else{
                $item_image_error = "The file extension must be '.png'.";
            }
        }

        if(empty(trim($_POST["item_destiny"]))){
            $item_destiny_error = "Please enter a item destiny.";
        }  
        else{
            if(trim($_POST["item_destiny"]) == "top-sale" || trim($_POST["item_destiny"]) == "special-price" || trim($_POST["item_destiny"]) == "new-phone"){
                $item_destiny = trim($_POST["item_destiny"]);
            }
            else{
                $item_destiny_error = "Item destiny can only be 'top-sale' or 'special-price' or 'new-phone'";
            }
        }

        if(empty($item_brand_error) && empty($item_name_error) && empty($item_price_error) && empty($item_image_error) && empty($item_image_destiny)){

            number_format((double)round($item_price,2, PHP_ROUND_HALF_DOWN),2,'.',',');  
            $item_register = date("Y-m-d H:i:s");

            // Prepare query
            $query = "INSERT INTO product (item_brand, item_name, item_price, item_image, item_register, item_destination) VALUES (?, ?, ?, ?, ?, ?)";
            
            if($result = $mysqli->prepare($query)){
                $result->bind_param("ssdsss", $param_item_brand, $param_item_name, $param_item_price, $param_item_image, $param_item_register, $param_item_destination);
                
                // Set parameters
                $param_item_brand = $item_brand;
                $param_item_name =  $item_name;
                $param_item_price = $item_price;
                $param_item_image .= "./assets/products/";
                $param_item_image .= $item_image;
                $param_item_register = $item_register;
                $param_item_destination = $item_destiny;


                if($result->execute()){
                    $addOrNot = 1;
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

    if($addOrNot == 1){ 
        ?>
        <h1 style="text-align: center;">ADMIN PANEL</h1>
            <div class="addedNewItem">
                <h2><br><br><br><br>Product has been successfully added to the store</h2>
                <br><input type="submit" class="btn btn-success font-size-18" onClick="history.back();" value="Back">
            </div> 
        <?php
    }
    else
    {
        include('admin.php');
    }

    // include footer.php file
    include ('footer.php');
?>