<?php
include 'database.php';
session_start();
$database = new DatabaseAdaptor();

if(isset($_GET['mode'])) {
    if ($_GET['mode'] == "register") {
        // Add user record to register
        $email = htmlspecialchars($_POST['email']);
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $password = htmlspecialchars($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Add address record and get id
        $street_address = htmlspecialchars($_POST['street_address']);
        $city = htmlspecialchars($_POST['city']);
        $state = htmlspecialchars($_POST['state']);
        $zip = htmlspecialchars($_POST['zip']);
        $address_id = $database->addAddress($street_address, $city, $state, $zip);

        if(! $database->userExists($email)) {
            $database->registerUser($email, $first_name, $last_name, $address_id, $hashed_password);
            // Redirect user to homepage
            header("Location: index.html");
        }
        else {
            $_SESSION ['registrationError'] = 'Email address taken.';
            header("Location: ./register.php");
        }
    }
    elseif ($_GET['mode'] == "login") {
        // check if user is valid
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        if ($database->verifyUser($email, $password)) {
            // Store session data so the account name isset and known on any page
            $_SESSION ['user'] = $email;
            // Redirect user to homepage
            header("Location: index.html");
        } else {
            $_SESSION ['loginError'] = 'Invalid Account/Password';
            header("Location: ./login.php?mode=login");
        }
    }
    elseif ($_GET['mode'] == "view") {
        $pizzas = $database->getPizzas();
        echo json_encode($pizzas);
    }
    elseif ($_GET['mode'] == "add") {
        // Only add to cart if user is signed in
        if(isset($_SESSION['user'])) {
            $database->addToCart($_POST['pizza'], $_POST['size']);
            header("Location: index.html");
        }
        else {
            $_SESSION ['loginError'] = 'Please sign in to add to cart.';
            header("Location: ./login.php?mode=login");
        }
    }
    elseif ($_GET['mode'] == "cart") {
        if(isset($_SESSION['user'])) {
            echo json_encode($database->getCart());
        }
        else {
            $_SESSION ['loginError'] = 'Please sign in to view your cart.';
            header("Location: ./login.php?mode=login");
        }
    }
    elseif ($_GET['mode'] == "order") {
        $database->orderPizzas();
        unset($_SESSION['cart']);
        header("Location: index.html");
    }
    elseif ($_GET['mode'] == "orders") {
        if(isset($_SESSION['user'])) {
            echo json_encode($database->getOrders($_SESSION['user']));
        }
        else {
            $_SESSION ['loginError'] = 'Please sign in to view your cart.';
            header("Location: ./login.php?mode=login");
        }
    }
}
?>
