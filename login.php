<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h3>Login</h3>
        <form action="controller.php" method="post">
            <div class="loginContainer">
                <div class="labels">Username&nbsp;</div>
                <div class="fields">
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="labels">Password&nbsp;</div>
                <div class="fields">
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="fields">
                    <input type="submit" name="register" value="Register"><br>
                    <?php
                        session_start();
                        if(isset($_SESSION ['registrationError']) {
                            echo $_SESSION ['registrationError'];
                            unset($_SESSION ['registrationError']);
                        }
                    ?>
                </div>
            </div>
        </form>
    </body>
</html>
