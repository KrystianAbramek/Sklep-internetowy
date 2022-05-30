<div class="logout">
    <br><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</div>
    <br><br><br>
<h1 style="text-align: center;">ADMIN PANEL</h1>
    <br>
<div class="productTable">
    <table class="table" align="center">
        <thead class="thead-dark">
            <tr>
                <th>Item Id</th>
                <th>Item brand</th>
                <th>Item name</th>
                <th>Item price</th>
                <th>Item register time</th>
                <th>Item destiny</th>
                <th>Edit item parameters</th>
                <th>Remove item</th>
            </tr>
        </thead>
<?php 
    
    $mysqli = new mysqli('localhost', 'root', '', 'shopee'); 


    $query = "SELECT item_id, item_brand, item_name, item_price, item_register, item_destination FROM product";
    $result = $mysqli -> query($query);
            
    while($value = $result -> fetch_array())
    {
        echo "<tr>";
        echo "<th scope='row'>" . $value['item_id'] . "</th>";
        echo "<td>" . $value['item_brand'] . "</td>";
        echo "<td>" . $value['item_name'] . "</td>";
        echo "<td>" . $value['item_price'] . "</td>";
        echo "<td>" . $value['item_register'] . "</td>";
        echo "<td><span class='badge badge-pill badge-"; 
        if($value['item_destination'] == "top-sale"){
            echo "success";
        }
        elseif($value['item_destination'] == "special-price"){
            echo "warning";
        } 
        elseif($value['item_destination'] == "new-phone"){
            echo "dark";
        }
        else{
            echo "secondary";
        } 
        echo " font-size-20'>" . $value['item_destination'] . "</span></td>";
        echo "<td><form action='editItem.php' method='post'><input style='width: 26.5%;' type='submit' class='btn btn-primary font-size-18' name='" . $value['item_id'] . "' value='Edit'></form></td>";
        echo "<td><form method='post'><input type='submit' class='btn btn-danger font-size-18' name='" . $value['item_id'] . "' value='Remove'></form></td>";
        echo "</tr>";
    }

    $mysqli -> close();
        
?>

    </table>
</div>