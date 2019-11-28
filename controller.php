<?php
include 'adaptor.php';
session_start();
$database = new DatabaseAdaptor();

if(isset($_GET['mode'])) {
    if ($_GET['mode'] == "register") {
        // Add user record to register
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Add address record and get id
        $street_address = $_POST['street_address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $address_id = $database->addAddress($street_address, $city, $state, $zip);

        $database->registerUser($email, $first_name, $last_name, $address_id, $hashed_password);
        // Redirect user to homepage
        header("Location: index.html");
    }
    elseif ($_GET['mode'] == "login") {
        // check if user is valid
        $email = $_POST['email'];
        $password = $_POST['password'];
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
}

?>
