<?php
if (isset ( $_POST ['login'] )) {
    if ($myDatabaseFunctions->verified($username, $password)) {
        // Store session data so the account name isset and known on any page
        $_SESSION ['user'] = $username;
        // Return to the main page where the user's account name
        // is known and $_SESSION ['user'] is set
        header ( "Location: index.html" );
    } else {
        $_SESSION ['loginError'] = 'Invalid Account/Password';
        header ( "Location: ./login.php?mode=login" );
    }
}

?>
