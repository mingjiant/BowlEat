<?php include('includes/functions.php') ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bowl Eat</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="header_top">
            <label class="logo">Bowl Eat</label>
            <ul class="top_right">

                <?php 
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']['username'];
                        echo "<i><a href=index.php?logout='1'>(logout)</a></i>";
                    } else {
                        echo "<li><a href='sign_in.php'>Sign in</a></li>
                              <li><a href='sign_up.php'>Sign up</a></li>";
                    }
                ?>

                <li><a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:30px"></i></a></li>    
            </ul>
        </div>
            
        <div class="container">
            <nav>
                <ul class="nav_links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li> 
                    <li><a href="aboutUs.php">About Us</a></li> 
                    <li><a href="contactUs.php">Contact Us</a></li> 
                </ul>
            </nav>    
        </div>
    </header>
    <?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
	<?php endif ?>
</body>