<?php include('includes/functions.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
        <title>Sign in</title>
    </head>

    <body>
        <div class="form_header">
            <h2>Sign in</h2>
        </div>

        <div class="user_form">
        <?php echo display_error(); ?>

        <form method="post" action="sign_in.php">
            <div class="form_input">
                <input placeholder="Username" type="text" name="username">
            </div>
            <div class="form_input">
                <input placeholder="Password" type="password" name="password">
            </div>
            <br>
            <div class="form_input">
                <button type="submit" class="button" name="sign_in_button">Sign in</button>
            </div>
            <p class="form_left">
                Not a member? <a href="sign_up.php">Sign up</a>
            </p>
            <p class="form_left">
                <a href="index.php">Back to home</a>
            </p>
        </form>
        </div>
    </body>
</html>