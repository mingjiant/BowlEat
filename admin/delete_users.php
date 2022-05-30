<?php 
    include('../includes/functions.php');

    // Check for user Id 
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // From view_users.php
        $id = $_GET['id'];
    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {  // Form submission.
        $id = $_POST['id'];
    } else {    // If no valid Id found
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    // Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Delete the user 
        if ($_POST['sure'] == 'Yes') {

            // Make the query:
            $query  = "DELETE FROM users WHERE id=$id LIMIT 1";		
            $result = mysqli_query($db, $query);
            if (mysqli_affected_rows($db) == 1) {
                echo '<p>The user has been deleted.</p>';
                echo '<a href="view_users.php">Back</a>';	

            } else {
                echo '<p class="error">Sorry! The user could not be deleted. </p>';
                echo '<p>' . mysqli_error($db) . '<br />Query: ' . $q . '</p>';
                echo '<a href="view_users.php">Back</a>';

            }
        } else { 
            echo '<p>The user has NOT been deleted.</p>';
            echo '<a href="view_users.php">Back</a>';
        }
    } else {
        // Retrieve the user's information:
        $query  = "SELECT username FROM users WHERE id=$id";
        $result = @mysqli_query ($db, $query);

        if (mysqli_num_rows($result) == 1) {
            // Get the user's information:
		    $row = mysqli_fetch_array ($result, MYSQLI_NUM);
?>

<head>
    <title>Bowl Eat Admin - Delete User</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

    <body>
        <div class="delete_header">
            <h2>Delete User</h2>
        </div>

        <!-- Create the form -->
        <div class="delete_form">
            <!-- Display the user record -->
            <p>Username: <?php echo $row[0] ?> </p>
            <p>Are you sure you want to delete this user?</p>

            <form action="delete_users.php" method="post">
                <div class="radio_input">
                    <input type="radio" name="sure" value="Yes"> Yes 
                    <input type="radio" name="sure" value="No" checked="checked"> No
                </div>
                <div>
                    <button type="submit" class="button" name="submit_button">Submit</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <span class="delete_left">
                    <a href="view_users.php">Back</a>
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