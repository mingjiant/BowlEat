<?php 
    include('../admin/admin_header.php'); 

    if (!isAdmin()) {
		header('location: ../sign_in.php');
	};

    // Determine the sorting of the user list
    // Set default sort by registration date
    $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

    //Determine the sorting order
    switch($sort) {
        case 'username':
            $order_by = 'username ASC';
            break;
        case 'email':
            $order_by = 'email ASC';
            break;
        case 'rd':
            $order_by = 'registration_date ASC';
            break;
        default:
            $order_by = 'registration_date ASC';
            $sort = 'rd';
            break;
    }

    // Define the query
    $query  = "SELECT username, user_type, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, email, id FROM users ORDER BY $order_by";
    $result = mysqli_query($db, $query);
?>

<head>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>
    <div class="title">
        <h2>User List</h2>
    </div>

    <div class="user_list">
        <table class="user_table" cellpadding="5" cellspacing="0">
            <!-- User list table header -->
            <tr>
                <th style="text-align:left;" width="10%"><a href="view_users.php?sort=username">Username</a></th>
                <th style="text-align:left;" width="15%"><a href="view_users.php?sort=email">Email</a></th>
                <th style="text-align:left;" width="10%">User Type</th>
                <th style="text-align:left;" width="10%"><a href="view_users.php?sort=rd">Registration Date</a></th>
                <th style="text-align:center;" width="5%">Edit</th>
                <th style="text-align:center;" width="5%">Delete</th>
            </tr>

            <!-- User list table records -->
            <?php 
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td style="text-align:left"><?php echo $row['username']; ?></td>
                    <td style="text-align:left"><?php echo $row['email']; ?></td>
                    <td style="text-align:left"><?php echo $row['user_type']; ?></td>
                    <td style="text-align:left"><?php echo $row['dr']; ?></td>
                    <td style="text-align:center"><a href="edit_users.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                    <td style="text-align:center"><a href="delete_users.php?id=<?php echo $row['id']; ?>">Delete</a></td>
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