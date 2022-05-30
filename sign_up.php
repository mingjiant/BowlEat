<?php include('includes/functions.php')?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
        <title>Sign up</title>
    </head>

    <body>
        <div class="form_header">
            <h2>Sign Up</h2>
        </div>

        <div class="user_form">

            <form method="post" action="sign_up.php">

            <?php echo display_error(); ?>

            <div class="form_input">
                <input placeholder="Username" type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="form_input">
                <input placeholder="Email" type="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="form_input">
                <input placeholder="Password" type="password" name="password">
            </div>
            <div class="form_input">
                <input placeholder="Confirm Password" type="password" name="password_confirm">
            </div>
            <br>
            <div class="form_input">
                <button type="submit" class="button" name="sign_up_button">Sign up</button>
            </div>
            <p class="form_left">
                Already a member? <a href="sign_in.php">Sign in</a>
            </p>
            <p class="form_left">
                <a href="index.php">Back to home</a>
            </p>
        </div>
    </body>
</html>