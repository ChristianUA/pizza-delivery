<?php
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
        $stmt = $this->DB->prepare("INSERT INTO users (email, first_name, last_name, address_id, password_hash) VALUES (?, ?, ?, ?, ?);");
        $stmt->execute([$email, $first_name, $last_name, $address_id, $hashed_password]);
    }

    public function verifyUser($email, $password) {
        // Return true if user exists in database and password matches
        $stmt = $this->DB->prepare("SELECT password_hash FROM users WHERE email=?");
        $stmt->execute([$email]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) == 1) {
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
        $stmt = $this->DB->prepare("SELECT * FROM orders WHERE email=?");
        $stmt->execute([$email]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPizzas() {
        $stmt = $this->DB->prepare("SELECT * FROM pizzas");
        $stmt->execute([$email]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
