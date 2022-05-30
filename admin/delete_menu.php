<?php 
    include('../includes/functions.php');

    // Check for product Id 
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From view_menu.php
        $id = $_GET['id'];
    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {  // Form submission.
        $id = $_POST['id'];
    } else {    // If no valid Id found
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    // Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Delete the product 
        if ($_POST['sure'] == 'Yes') {

            // Make the query:
            $query  = "DELETE FROM products WHERE id=$id LIMIT 1";		
            $result = mysqli_query($db, $query);
            if (mysqli_affected_rows($db) == 1) {
                echo '<p>The product has been removed.</p>';
                echo '<a href="view_menu.php">Back</a>';	

            } else {
                echo '<p class="error">Sorry! The product could not be removed. </p>';
                echo '<p>' . mysqli_error($db) . '<br />Query: ' . $q . '</p>';
                echo '<a href="view_menu.php">Back</a>';

            }
        } else { 
            echo '<p>The product has NOT been removed.</p>';
            echo '<a href="view_menu.php">Back</a>';
        }
    } else {
        // Retrieve the product's information:
        $query  = "SELECT picture, name FROM products WHERE id=$id";
        $result = @mysqli_query ($db, $query);

        if (mysqli_num_rows($result) == 1) {
            // Get the product's information:
		    $row = mysqli_fetch_array ($result, MYSQLI_NUM);
?>

<head>
    <title>Bowl Eat Admin - Delete Menu</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

    <body>
        <div class="delete_header">
            <h2>Delete Product</h2>
        </div>
            
        <!-- Create the form -->
        <div class="delete_form">
            <!-- Display the product record -->
            <p class="delete_img"><img src="../<?php echo $row['0'] ?>"></p>
            <p>Product name: <?php echo $row[1] ?> </p>
            <p>Are you sure you want to remove this product?</p>

            <form action="delete_menu.php" method="post">
                <div class="radio_input">
                    <input type="radio" name="sure" value="Yes"> Yes 
                    <input type="radio" name="sure" value="No" checked="checked"> No
                </div>
                <div>
                    <button type="submit" class="button" name="submit_button">Submit</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <span class="delete_left">
                    <a href="view_menu.php">Back</a>
                </span>
                <br>
                <span class="delete_left">
                    <a href="admin_home.php">Back to home</a>
                </span>
            </form>
        </div>
<?php 
        } else { 
            echo '<p class="error">This page has been accessed in error.</p>';
        }
    }
    mysqli_close($db);
?>