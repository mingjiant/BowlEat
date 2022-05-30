<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'bowleat';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    if (!$conn) {
        die ("Failed to connect: ".mysqli_connect_error());
    }
    echo "Connected successfully.<br>";

    $users_table = 'CREATE TABLE users(
            id INT(10) AUTO_INCREMENT,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            user_type VARCHAR(10) NOT NULL,
            password VARCHAR(100) NOT NULL,
            registration_date DATETIME NOT NULL,
            primary key(id))';

    $contact_us_table = 'CREATE TABLE contacts(
            id INT(10) AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            contact_number VARCHAR(15) NOT NULL,
            subject VARCHAR(200) NOT NULL,
            message VARCHAR(255) NOT NULL,
            created_date DATETIME NOT NULL,
            primary key(id))';

    $product_table = 'CREATE TABLE products(
            id INT(10) AUTO_INCREMENT,
            product_id INT(5) NOT NULL,
            category_id INT(10) NOT NULL,
            name VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            price DOUBLE(8,2) NOT NULL,
            picture VARCHAR(200) NOT NULL,
            primary key(id))';

    $tables = [$users_table, $contact_us_table, $product_table];
    $errors = [];

    foreach($tables as $k => $sql) {
        $query = @$conn->query($sql);

        if(!$query) {
            $errors[] = "Table $k : Creation failed ($conn->error)";
        } else {
            $errors[] = "Table $k : Created successfully";
        }
    }

    foreach($errors as $msg) {
        echo "$msg <br>";
    }

    $insert_products = "INSERT INTO products (product_id, category_id, name, description, price, picture) VALUES
                        (100, 1, 'Miso Salmon', 'A mixture of Japanese taste comes with Miso paste.', 19.90, 'images/salmon.png'),
                        (101, 1, 'Shoyu Salmon', 'The perfect choice for first time healthy bowl goers to taste the marriage of Hawaii and Japan!', 19.90, 'images/salmon-2.png'),
                        (102, 1, 'Spicy Tuna', \"With bird’s eye chili into the shoyu marinade for that immense kick, it's a punch to your taste buds!\", 21.90, 'images/salmon-3.png'),
                        (200, 2, 'Herb Chicken', 'Marinade herb chicken with specialised garlic sauce? What a great combination!', 16.90, 'images/chicken.png'),
                        (201, 2, 'Cajun Chicken Breast', 'Tender chicken breast marinated overnight in buttermilk and infused perfectly with Cajun seasoning.', 16.90, 'images/chicken-2.png'),
                        (300, 3, 'Mango Salad Shrimp', 'Tropical mango salsa made fresh daily and tossed with our lightly grilled shrimp.', 20.90, 'images/shrimp.png'),
                        (400, 4, 'Avo-Lover', 'Chunks of avocado drizzled with lemon juice to keep you going for more!', 14.90, 'images/veggie.png'),
                        (401, 4, 'Hawaiian Tofu', 'Chucks of tofu drizzled with herby lime sauce to keep you craving for more', 14.90, 'images/veggie-2.png'),
                        (500, 5, 'Unagi Special', 'Freshwater eel with the impeccable combination of Asian-inspired garnishes such as onsen egg, pickled radish, furikake, carrots and fish roe.', 28.90, 'images/unagi.png')";

    $insert_data = [$insert_products];


    foreach($insert_data as $k => $sql) {
        $query = @$conn->query($sql);

        if(!$query) {
            $errors[] = "Data $k : Failed to insert($conn->error)";
        } else {
            $errors[] = "Data $k : Insert successfully";
        }
    }

    foreach($errors as $msg) {
        echo "$msg <br>";
    }
    
    mysqli_close($conn);
?>