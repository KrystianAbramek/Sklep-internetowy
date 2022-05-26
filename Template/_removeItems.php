<div class="logout">
    <br><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</div>
    <br><br><br>
<h1 style="text-align: center;">ADMIN PANEL</h1>
    <br>
    <div class="removeItem">
        <h2>Remove some items from store</h2>
        <p>Please fill this form to delete item.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Item id that you want to remove from the store</label>
                <div id="removeId"><input type="number" name="remove_item_id" class="form-control <?php echo (!empty($remove_item_id_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $remove_item_id; ?>"></div>
                <span class="invalid-feedback"><?php echo $remove_item_id_error; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-success font-size-18" value="Submit">
                <input type="reset" class="btn btn-danger font-size-18" value="Reset">
            </div>
        </form>
    </div>

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
            echo "<td>" . $value['item_destination'] . "</td>";
            echo "</tr>";
        }

        $mysqli -> close();
            
    ?>
    </table>
</div>