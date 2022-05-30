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

    // Check for the form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = array();

        // Check for the username
        if (empty($_POST['username'])) {
            $errors[] = 'You forgot to enter the username.';
        } else {
            $username = e($_POST['username']);
        }

        // Check for the user_type
        if (empty($_POST['user_type'])) {
            $errors[] = 'You forgot to enter the user type.';
        } else {
            $user_type = e($_POST['user_type']);
        }

        // Check for the email address
        if (empty($_POST['email'])) {
            $errors[] = 'You forgot to enter the email address.';
        } else {
            $email= e($_POST['email']);
        }

        // If no errors
        if (empty($errors)) {
            // Test for unique email address
            $query  = "SELECT id FROM users WHERE email='$email' AND id != $id";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 0) {
                // Set the query
                $query =  "UPDATE users SET username='$username', user_type='$user_type', email='$email' WHERE id=$id LIMIT 1";
                $result = mysqli_query($db, $query);
                if (mysqli_affected_rows($db) == 1) {

                    echo '<p>The user information has been edited.</p>';	
                    
                } else {
                    echo '<p class="error">Sorry! The user could not be edited.</p>';
                    echo '<p>' . mysqli_error($db) . '<br />Query: ' . $query . '</p>';
                }
                    
            } else {
                echo '<p class="error">The email address has already been registered.</p>';
            }
        } else {
            echo '<p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) {
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p>';
        }
    }

    // Retrive all the user's information
    $query  = "SELECT username, user_type, email FROM users WHERE id=$id";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            // Get the user's information
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
?>

<head>
    <title>Bowl Eat Admin - Edit User</title>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

    <body>
        <div class="edit_header">
            <h2>Edit User</h2>
        </div>

        <!-- Create the form -->
        <div class="edit_form">
            <form action="edit_users.php" method="post">
                <div class="edit_input">
                    <p>Username: <input placeholder="Username" type="text" name="username" value="<?php echo $row[0]; ?>"></p>
                </div>
                <div class="edit_input">
                    <p>User type: <input placeholder="User Type" type="text" name="user_type" value="<?php echo $row[1]; ?>"></p>
                </div>
                <div class="edit_input">
                    <p>Email: <input placeholder="Email" type="text" name="email" value="<?php echo $row[2]; ?>"></p>
                </div>
                <div class="edit_input">
                    <button type="submit" class="button" name="submit_button">Submit</button>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p class="edit_left">
                    <a href="view_users.php">Back</a>
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