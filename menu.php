<?php include('header.php') ?>

<head>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>
    <div class=top_content>
        <div class="menu_title">
            <img src="images/menu.jpeg"><h2>Our Menu</h2>
        </div>
    </div>

    <div class="products">
        <?php
            $query  = "SELECT * FROM products ORDER BY id ASC";
            $result = mysqli_query($db,$query);
            $num    = mysqli_num_rows($result);

            if ($num > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>
                    <form method="post" action="menu.php?cart=add&product_id=<?php echo $row["product_id"]; ?>">
                    <div class="product_card">
                        <div class="product_img">
                            <img src="<?php echo $row['picture'] ?>">
                        </div>
                        <div class="product_name">
                            <h3><?php echo $row['name'] ?></h3>
                        </div>
                        <div class="product_desc">
                            <p><?php echo $row['description'] ?></p>
                        </div>    
                        <div class="product_price">
                            <p><?php echo "RM ".number_format($row['price'],2) ?></p>
                        </div>
                        <div class="add_cart">
                            <span><input type="text" class="product_quantity" name="quantity" value="1" size="2"></span>
                            <span><button type="submit" class="add_cart_button" name="add_cart">Add to Cart</button></span>
                        </div>
                    </div>    
                    </form>
        <?php   }

                mysqli_free_result($result);
            } else {
                echo '<p class="error">There are no products.</p>';
            }
        ?>
    </div>
</body>
