<?php include 'header.php' ?>
<head>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
</head>
<body>
    <div class="top_content">
        <div class="contact_title">
            <img src="images/contact.jpeg"><h2>Contact Us</h2>
        </div>
    </div>

    <div class="enquiry_form">
        <h2>ENQUIRY & FEEDBACK</h2>
        <p>Have something to tell us? Feel free to drop us a message. We will get back to you soonest</p>
    </div>

    <form method="post" action="contactUs.php">

        <?php echo display_error(); ?>

        <?php if (isset($_SESSION['success'])) : ?>

            <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);    
            ?>
        
        <?php endif ?>

        <div class="form_input">
            <input placeholder="Name" type="text" name="name">
        </div>
        <div class="form_input">
            <input placeholder="Email" type="text" name="email">
        </div>
        <div class="form_input">
            <input placeholder="Contact number" type="text" name="contact">
        </div>
        <div class="form_input">
            <input placeholder="Subject" type="text" name="subject">
        </div>
        <div class="form_input">
            <textarea placeholder="Your message here" name="message"></textarea>
        </div>
        <br>
        <div class="form_input">
            <button type="submit" class="button" name="submit">Submit</button>
        </div>
    </form>
</body>
