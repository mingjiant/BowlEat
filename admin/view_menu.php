<?php 
    include('../admin/admin_header.php'); 

    if (!isAdmin()) {
		header('location: ../sign_in.php');
	};

    // Define the query
    $query  = "SELECT * FROM products ORDER BY id ASC";
    $result = mysqli_query($db,$query);
?>

<head>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>
    <div class="title">
        <h2>Menu List</h2>
    </div>

    <div class="menu_list">
        <table class="menu_table" cellpadding="5" cellspacing="0">
            <!-- Menu list table header -->
            <tr>
                <th style="text-align:center;" width="10%"></th>
                <th style="text-align:left;" width="15%">Name</th>
                <th style="text-align:left;" width="15%">Description</th>
                <th style="text-align:center;" width="10%">Unit Price (RM)</th>
                <th style="text-align:center;" width="5%">Edit</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>

            <!-- Menu list table records -->
            <?php 
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td style="text-align:center;"><img src="../<?php echo $row['picture'] ?>"></td>
                    <td style="text-align:left;"><?php echo $row['name']; ?></td>
                    <td style="text-align:left;"><?php echo $row['description']; ?></td>
                    <td style="text-align:center;"><?php echo $row['price']; ?></td>
                    <td style="text-align:center;"><a href="edit_menu.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td style="text-align:center;"><a href="delete_menu.php?id=<?php echo $row['id']; ?>">Remove</a></td>
                </tr>
            <?php 
                }
            ?>
        </table>
    </div>
    
    <?php 
        mysqli_free_result($result);
        mysqli_close($db);
    ?>
</body>