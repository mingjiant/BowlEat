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

    // Check for the form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();

        // Check for the product's name
        if (empty($_POST['name'])) {
            $errors[] = 'You forgot to enter the name.';
        } else {
            $name = e($_POST['name']);
        }

        // Check for the product's description
        if (empty($_POST['description'])) {
            $errors[] = 'You forgot to enter the descriptions.';
        } else {
            $description = e($_POST['description']);
        }

        // Check for the product's price
        if (empty($_POST['price'])) {
            $errors[] = 'You forgot to enter the price.';
        } else {
            $price= e($_POST['price']);
        }

        // If no errors
        if (empty($errors)) {
            // Set the query
            $query =  "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id LIMIT 1";
            $result = mysqli_query($db, $query);
            if (mysqli_affected_rows($db) == 1) {

                echo '<p>The product information has been edited.</p>';	
                
            } else {
                echo '<p class="error">Sorry! The product could not be edited.</p>';
                echo '<p>' . mysqli_error($db) . '<br />Query: ' . $query . '</p>';
            }
        } else {
            echo '<p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) {
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p>';
        }
    }

    // Retrive all the product's information
    $query  = "SELECT name, description, price FROM products WHERE id=$id";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            // Get the product's information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
?>

<head>
    <title>Bowl Eat Admin - Edit Menu</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

    <body>
        <div class="edit_header">
            <h2>Edit Product</h2>
        </div>

        <!-- Create the form -->
        <div class="edit_form">
            <form action="edit_menu.php" method="post">
                <div class="edit_input">
                    <p>Name: <input placeholder="Name" type="text" name="name" value="<?php echo $row[0]; ?>"></p>
                </div>
                <div class="edit_input">
                    <p>Description: <input placeholder="Description" name="description" size="500" value="<?php echo $row[1]; ?>"></p>
                </div>
                <div class="edit_input">
                    <p>Price (RM): <input placeholder="Price" type="text" name="price" value="<?php echo $row[2]; ?>"></p>
                </div>
                <div class="edit_input">
                    <button type="submit" class="button" name="submit_button">Submit</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p class="edit_left">
                    <a href="view_menu.php">Back</a>
                </p>
                <p class="edit_left">
                    <a href="admin_home.php">Back to home</a>
                </p>
            </form>
        </div>
    <?php 
        } else {
            echo '<p class="error">This page has been accessed in error.</p>';
        }

        mysqli_close($db);
    ?>
</body>