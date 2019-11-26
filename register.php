<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body class="text-center" data-gr-c-s-loaded="true">
        <h3>Register</h3>
        <form class="form-signin">
          <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
          <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" data-keeper-lock-id="k-ya7f8ax2tqa">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" data-keeper-lock-id="k-gn286anrirk">
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          <p class="mt-5 mb-3 text-muted">© 2017-2019</p>
        </form>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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
