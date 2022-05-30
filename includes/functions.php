<?php 
    session_start();

    // connect to database
    $db = mysqli_connect('localhost','root','','bowleat');

    // variable declaration 
    $username   = "";
    $email      = "";
    $errors     = array();

    // call signup() function if sign_up_button is clicked
    if (isset($_POST['sign_up_button'])) {
        signup();
    }

    // call signin() function if sign_in_button is clicked
    if (isset($_POST['sign_in_button'])) {
        signin();
    }

    // clear the user session when logout is clicked
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header('location: index.php');
    }

    // call contact() function if contactUs submit button is clicked
    if (isset($_POST['submit'])) {
        contact();
    }

    // User sign up
    function signup() {
        global $db, $errors;

        // get the information from the form
        $username           = e($_POST['username']);
        $email              = e($_POST['email']);
        $password           = e($_POST['password']);
        $password_confirm   = e($_POST['password_confirm']);

        // form validation
        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (empty($email)) {
            array_push($errors, "Email is required");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if ($password != $password_confirm) {
            array_push($errors, "Password do not match!");
        }

        // register user if there is no error 
        if (count($errors) == 0) {
            $e_password = sha1($password);   // encrypt the password

            $query = "INSERT INTO users (username, email, user_type, password, registration_date)
                      VALUES('$username','$email','user','$e_password',NOW())";
            mysqli_query($db, $query);

            // get id for the created user
            $signed_in_user_id = mysqli_insert_id($db);

            $_SESSION['user']       = getUserById($signed_in_user_id); // put signed in user in session
            $_SESSION['success']    = "You are logged in";
            header('location: index.php');
        }
    }

    // Return user array from their ID
    function getUserById($id) {
        global $db;
        $query  = "SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($db, $query);
            
        $user   = mysqli_fetch_assoc($result);
        return $user;
    }

    //  User sign in
    function signin() {
        global $db, $username, $errors;

        // get the information from the form
        $username = e($_POST['username']);
        $password = e($_POST['password']);

        // form validation
        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        // sign in user if there is no error
        if (count($errors) == 0) {
            $e_password = sha1($password); // encrypt the password 

            $query = "SELECT * FROM users WHERE username='$username' AND password='$e_password' LIMIT 1";
            $results = mysqli_query($db, $query);

            if (mysqli_num_rows($results) == 1) { // user found in the database
                // check the user type
                $logged_in_user = mysqli_fetch_assoc($results);
                if ($logged_in_user['user_type'] == 'admin') {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "You have logged in";
                    header('location: admin/admin_home.php');
                } else {
                    $_SESSION['user'] = $logged_in_user;
                    $_SESSION['success'] = "You have logged in";
                    header('location: index.php');
                }

            } else {
                array_push($errors, "Wrong username or password combination");
            }
        }
    }

    // e function - escape string and trim the input
    function e($val) {
        global $db;
        return mysqli_real_escape_string($db, trim($val));
    }

    // to prevent outsiders to access Admin page through the website link, this will direct the user to sign in page
    function isAdmin() {
        if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    // display all the errors
    function display_error() {
        global $errors;

        if (count($errors) > 0) {
            echo '<div class="error">';
                foreach($errors as $error) {
                    echo $error . "<br>";
                }
            echo '</div>';
        }
    }

    // Contact us form
    function contact() {
        global $db, $errors;

        // get the information from the form
        $name       = e($_POST['name']);
        $email      = e($_POST['email']);
        $contact    = e($_POST['contact']);
        $subject    = e($_POST['subject']);
        $message    = e($_POST['message']);

        // form validation
        if (empty($name)) {
            array_push($errors, "Name is required");
        }

        if (empty($email)) {
            array_push($errors, "Email is required");
        }

        if (empty($contact)) {
            array_push($errors, "Contact number is required");
        }

        if (empty($subject)) {
            array_push($errors, "Subject cannot be empty");
        }

        if (empty($message)) {
            array_push($errors, "Message cannot be empty");
        }

        // insert the query if no error
        if (count($errors) == 0) {
            $query  = "INSERT INTO contacts (name, email, contact_number, subject, message, created_date)
                       VALUES ('$name','$email','$contact','$subject','$message',NOW())";
            if (!$result = $db->query($query)) {
                die('There was an error running the query ['. $db->error .']'); 
            } else {
                $_SESSION['success'] = "Thank you for your enquiry, we will reply you soonest";
            }
        } else {
            array_push($errors, "Failed to send the enquiry, please try again");
        }
    }

    // runQuery($query) function - run the query entered
    function runQuery($query) {
        global $db;
		$result = mysqli_query($db,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}

    // Shopping Cart
    if (!empty($_GET['cart'])) {
        switch($_GET['cart']) {

            // add item to cart 
            case "add":
                if(!empty($_POST['quantity'])) {
                    $product        = runQuery("SELECT * FROM products WHERE product_id='".$_GET["product_id"]."'");
                    $productArray   = array($product[0]['product_id']=>array('name'=>$product[0]['name'], 'product_id'=>$product[0]['product_id'], 'quantity'=>$_POST['quantity'], 'price'=>$product[0]['price'], 'picture'=>$product[0]['picture']));
                    if(!empty($_SESSION['cart_item'])) {
                        if(in_array($product[0]['product_id'], array_keys($_SESSION['cart_item']))) {
                            foreach($_SESSION['cart_item'] as $key => $value) {
                                if(empty($_SESSION['cart_item'][$key]['quantity'])) {
                                    $_SESSION['cart_item'][$key]['quantity'] = 0;
                                }
                                $_SESSION['cart_item'][$key]['quantity'] += $_POST['quantity'];
                            }
                        } else {
                            $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'],$productArray);
                        }
                    } else {
                        $_SESSION['cart_item'] = $productArray;
                    }
                    $_SESSION['success']    = "Item has been added to cart";
                }
            break;

            // remove the item from cart 
            case "remove":
                $product_id = $_GET['product_id'];
                if(!empty($_SESSION['cart_item'])) {
                    foreach($_SESSION['cart_item'] as $key => $value) {
                        if($value['product_id'] == $product_id)
                            unset($_SESSION['cart_item'][$key]);
                        if(empty($_SESSION['cart_item']))
                            unset($_SESSION['cart_item']);
                            $_SESSION['success']    = "Item has been removed";
                    }
                }
            break;

            // empty the cart
            case "empty":
                unset($_SESSION['cart_item']);
                $_SESSION['success']    = "Your cart has been cleared";
            break;
        }
    }
?>