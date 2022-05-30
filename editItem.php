<?php

$mysqli = new mysqli('localhost', 'root', '', 'shopee'); 

?>

<?php
ob_start();
// include header.php file
include ('header.php');

$edit_item_id = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    foreach($_POST as $key => $value){ 
        $edit_item_id = $key;
    }

    if(empty($edit_item_id)){
        echo "Oops! Something went wrong. Please try again later.";
    }  
    else{

        $query = "SELECT item_id, item_brand, item_name, item_price, item_image, item_register, item_destination FROM product WHERE item_id={$edit_item_id}";
        $result = $mysqli -> query($query);

        while($value = $result -> fetch_array())
        {   
            echo "<div class ='addNewItem'>";
            echo "<h2>Edit item parameters</h2>";
                echo "<form action='edit.php' method='post'>";
                echo "<div class='form-group'>
                        <label>Item id</label>
                        <input type='number' name='item_id' class='form-control' value='" . $value['item_id'] . "' readonly>
                    </div>";

                echo "<div class='form-group'>
                        <label>Item brand</label>
                        <input type='text' name='item_brand' class='form-control' value='" . $value['item_brand'] . "'>
                      </div>";

                echo "<div class='form-group'>
                        <label>Item name</label>
                        <input type='text' name='item_name' class='form-control' value='" . $value['item_name'] . "'>
                      </div>";

                echo "<div class='form-group'>
                        <label>Item price</label>
                        <input type='number' name='item_price' class='form-control' value='" . $value['item_price'] . "'>
                      </div>";

                echo "<div class='form-group'>
                        <label>Item image path</label>
                        <input type='text' name='item_image' class='form-control' value='" . $value['item_image'] . "'>
                      </div>";

                echo "<div class='form-group'>
                        <label>Item register</label>
                        <input type='text' name='item_register' class='form-control' value='" . $value['item_register'] . "' readonly>
                      </div>";

                echo "<div class='form-group'>
                        <label>Item destiny</label>
                        <input type='text' name='item_destiny' class='form-control' value='" . $value['item_destination'] . "'>
                      </div>";
                
                echo "<div class='form-group'>
                        <input type='submit' class='btn btn-success font-size-18' name='new_data' value='Edit'>";
                echo "  <input type='reset' class='btn btn-danger font-size-18' value='Reset'>
                      </div>";
                echo "</form>";
            echo "</div>";
        }
        
    }
}

// include footer.php file
include ('footer.php');
?>