<?php include('header.php') ?>
<head>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>
    <div class="shopping_cart">
        <div class="top_content">
            <div class="cart_title">
                <img src="images/cart.jpg"><h2>Shopping Cart</h2>
            </div>
        </div>
        <div>
            <button class="emptyButton"><a href="cart.php?cart=empty">Empty Cart</a></button>
        </div>

        <?php 
            if(isset($_SESSION['cart_item'])) {
                $total_quantity = 0;
                $total_price    = 0;
        ?>

        <table class="cart_table" cellpadding="5" cellspacing="10">
            <tbody>
                <tr>
                    <th style="text-align:center;" width="5%"></th>
                    <th style="text-align:left;" width="15%">Name</th>
                    <th style="text-align:center;" width="5%">Quantity</th>
                    <th style="text-align:center;" width="10%">Unit Price (RM)</th>
                    <th style="text-align:center;" width="10%">Price (RM)</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
                <?php 
                    foreach($_SESSION['cart_item'] as $item) {
                        $item_price = $item['quantity']*$item['price'];
                ?>
                        <tr>
                            <td style="text-align:center;"><img src="<?php echo $item['picture'];?>" class="cart_item_img"></td>
                            <td style="text-align:left;"><?php echo $item['name']; ?></td>
                            <td style="text-align:center;"><?php echo $item['quantity']; ?></td>
                            <td style="text-align:center;"><?php echo $item['price']; ?></td>
                            <td style="text-align:center;"><?php echo number_format($item_price, 2); ?></td>
                            <td style="text-align:center;"><a href="cart.php?cart=remove&product_id=<?php echo $item['product_id'];?>" class="removeIcon"><img src="images/icon-delete.png"></a></td>
                        </tr>
                        <?php 
                        $total_quantity += $item['quantity'];
                        $total_price    += ($item['price']*$item['quantity']);
                    }
                        ?>

                <tr>
                    <td colspan="2" style="text-align:center;">Total: </td>
                    <td style="text-align:center;"><?php echo $total_quantity; ?></td>
                    <td colspan="2" style="text-align:center;"><strong><?php echo "RM ".number_format($total_price, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>
        <div class="checkout">
            <button class="checkoutButton"><a href="checkout.php">Checkout</a></button>
        </div>
        <?php 
        } else {
        ?>
        <div class="empty">Your Cart is Empty :(</div>
        <div class="gotomenu"><a href="menu.php">Go to menu</a></div>
        <?php 
        }
        ?>
    </div>
</body>