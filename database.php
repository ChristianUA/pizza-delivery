<?php

// <!-- Christian Peterson and Devanshi Chavda -->
class DatabaseAdaptor {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        $dataBase = 'mysql:dbname=final_project;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; // Empty string with XAMPP install
        try {
            $this->DB = new PDO($dataBase, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    }

    public function addAddress($street_address, $city, $state, $zip) {
        // Create address and return the ID to be tied to user
        $stmt = $this->DB->prepare("INSERT INTO addresses (street_address, city, state, zip) VALUES (?, ?, ?, ?);");
        $stmt->execute([$street_address, $city, $state, $zip]);
        return $this->DB->lastInsertId();
    }

    public function registerUser($email, $first_name, $last_name, $address_id, $hashed_password) {
        // TODO: Check if email address already exists
        // Create user
        $stmt = $this->DB->prepare("INSERT INTO users (email, first_name, last_name, address_id, password_hash) VALUES (:email, :first_name, :last_name, :address_id, :password_hash);");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':address_id', $address_id);
        $stmt->bindParam(':password_hash', $hashed_password);
        $stmt->execute();
    }

    public function userExists($email) {
        $stmt = $this->DB->prepare("SELECT email FROM users WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($results)) {
            return False;
        }
        else {
            return True;
        }
    }

    public function verifyUser($email, $password) {
        // Return true if user exists in database and password matches
        $stmt = $this->DB->prepare("SELECT password_hash FROM users WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($results)) {
            // select password_hash from first result
            $password_hash = $results[0]['password_hash'];

            if(password_verify($password, $password_hash)) {
                return True;
            }
            return False;
        }
        return False;
    }

    public function getOrders($email) {
        // User must already be verified
        $stmt = $this->DB->prepare("SELECT pizzas.name, pizzas.description, orders.size FROM orders JOIN users on orders.user_id = users.id JOIN pizzas on orders.pizza_id = pizzas.id WHERE users.email=:email;");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function orderPizzas() {
        foreach ($_SESSION['cart'] as $pizza) {
            $name = $pizza[0];
            $size = $pizza[1];
            $user = $_SESSION['user'];

            $stmt = $this->DB->prepare("SELECT id FROM pizzas WHERE name=:pizza");
            $stmt->bindParam(':pizza', $name);
            $stmt->execute();
            $pizzaID = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $this->DB->prepare("SELECT id FROM users WHERE email=:email");
            $stmt->bindParam(':email', $user);
            $stmt->execute();
            $userID = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $this->DB->prepare("INSERT INTO orders (user_id, pizza_id, size) VALUES (:user_id, :pizza_id, :size);");
            $stmt->bindParam(':user_id', $userID[0]['id']);
            $stmt->bindParam(':pizza_id', $pizzaID[0]['id']);
            $stmt->bindParam(':size', $size);
            $stmt->execute();
        }
    }

    public function getPizzas() {
        $stmt = $this->DB->prepare("SELECT name, toppings, description FROM pizzas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCart() {
        return $_SESSION['cart'];
    }

    public function addToCart($pizza, $size) {
        $stmt = $this->DB->prepare("SELECT description FROM pizzas WHERE name=:pizza");
        $stmt->bindParam(':pizza', $pizza);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(isset($_SESSION['cart'])) {
            array_push($_SESSION['cart'], array($pizza, $size, $results[0]['description']));
        }
        else {
            $_SESSION['cart'] = array(array($pizza, $size, $results[0]['description']));
        }
    }
}
?>
