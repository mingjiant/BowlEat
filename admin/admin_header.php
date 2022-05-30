<?php 
    include('../includes/functions.php'); 
?>

<head>
    <title>Bowl Eat - Admin</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>


<body>
    <header>
        <div class="header_top">
            <label class="logo">Bowl Eat</label>
            <ul class="admin_top_right">
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo $_SESSION['user']['username'];
                        echo "<i><a href=../index.php?logout='1'>(logout)</a></i>";
                    } 
                ?>
            </ul>
        </div>

        <div class="admin_container">
            <nav>
                <ul class="admin_nav_links">
                    <li><a href="../admin/admin_home.php">Home</a></li>
                    <li><a href="../admin/view_menu.php">View Menu</a></li> 
                    <li><a href="../admin/view_users.php">View Users</a></li> 
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