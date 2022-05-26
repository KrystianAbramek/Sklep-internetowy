<div class="logout">
    <br><a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</div>
    <br><br><br>
<h1 style="text-align: center;">ADMIN PANEL</h1>
    <br>
    <div class="addNewItem">
        <h2>Add new item to shop</h2>
        <p>Please fill this form to add new product.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Item brand (e.g., Samsung, Xiaomi, Apple)</label>
                <input type="text" name="item_brand" class="form-control <?php echo (!empty($item_brand_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_brand; ?>">
                <span class="invalid-feedback"><?php echo $item_brand_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Item name (e.g., Samsung Galxy 10, Redmi Note 9, Apple IPhone 5)</label>
                <input type="text" name="item_name" class="form-control <?php echo (!empty($item_name_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_name; ?>">
                <span class="invalid-feedback"><?php echo $item_name_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Item price</label>
                <input type="number" name="item_price" class="form-control <?php echo (!empty($item_price_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_price; ?>">
                <span class="invalid-feedback"><?php echo $item_price_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Item image name (i.e., image.png)</label>
                <input type="text" name="item_image" class="form-control <?php echo (!empty($item_image_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_image; ?>">
                <span class="invalid-feedback"><?php echo $item_image_error; ?></span>
            </div>    
            <div class="form-group">
                <label>Item destiny name (top-sale, special-price, new-phone)</label>
                <input type="text" name="item_destiny" class="form-control <?php echo (!empty($item_destiny_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_destiny; ?>">
                <span class="invalid-feedback"><?php echo $item_destiny_error; ?></span>
            </div>    

            <div class="form-group">
                <input type="submit" class="btn btn-success font-size-18" value="Submit">
                <input type="reset" class="btn btn-danger font-size-18" value="Reset">
            </div>
        </form>
    </div>