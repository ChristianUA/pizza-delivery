<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <!-- Christian Peterson and Devanshi Chavda -->
        <meta charset="utf-8">
        <title>Pizza Delivery</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    </head>
    <body onload="getPizzas()">
        <?php
            session_start();
        ?>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <a class="navbar-brand" href="#">Pizza Delivery</a>

              <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#" onclick="getPizzas()">Home</a>
                  </li>
                </ul>

                <nav class="my-2 my-md-0 mr-md-3">
                    <?php
                        if(isset($_SESSION['user'])) {
                            echo '<a class="p-2 text-dark" href="#" onclick="getOrders()">Orders</a><a class="p-2 text-dark" href="#" onclick="getCart()">Cart</a><a class="p-2 text-dark" href="./controller.php?mode=logout">Logout</a>';
                        }
                        else {
                            echo '<a class="p-2 text-dark" href="./login.php">Login</a>';
                        };
                    ?>
                </nav>
                <?php
                    if(!isset($_SESSION['user'])) {
                        echo '<a class="btn btn-outline-primary" href="./register.php">Register</a>';
                    }
                ?>
              </div>
            </nav>
            <h2 class="title m-4" id="title"></h2>
            <div class="row row-cols-3 row-cols-md-2" id="divtoChange"></div>
        </div>

        <script>
            function getPizzas() {
                document.getElementById("title").innerHTML = "Pizzas";
                document.getElementById("divtoChange").innerHTML = "";

                // Get pizzas from database
                var ajax = new XMLHttpRequest();
                ajax.open("GET", "controller.php?mode=view", true);
                ajax.send();
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var array = JSON.parse(ajax.responseText);
                        for (var index = 0; index < array.length; index++) {
                            var name = array[index]["name"];
                            var description = array[index]["description"];
                            document.getElementById("divtoChange").innerHTML += `<div class="col mb-4">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                          <img src="images/` + name.toLowerCase() + `.jpg" class="card-img" alt="` + name + ` pizza">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <form action="controller.php?mode=add" method="post">
                                                    <input type="hidden" name="pizza" value="` + name + `"/>
                                                    <h5 class="card-title">` + name + ` pizza</h5>
                                                    <p class="card-text">` + description + `</p>
                                                    <div class="form-row">
                                                        <div class="col-md-3 mb-3">
                                                            <label for="size">Size</label>
                                                            <select class="custom-select custom-select-sm" name="size" required>
                                                              <option value="Small" selected>Small</option>
                                                              <option value="Medium">Medium</option>
                                                              <option value="Large">Large</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Add to cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                    } // End if
                }; // End anonymous function
            };

            function getCart() {
                document.getElementById("title").innerHTML = "Cart";
                document.getElementById("divtoChange").innerHTML = "";
                // Get pizzas from database
                var ajax = new XMLHttpRequest();
                ajax.open("GET", "controller.php?mode=cart", true);
                ajax.send();
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var array = JSON.parse(ajax.responseText);
                        for (var index = 0; index < array.length; index++) {
                            var name = array[index][0];
                            var size = array[index][1];
                            var description = array[index][2];
                            document.getElementById("divtoChange").innerHTML += `<div class="col mb-4">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                          <img src="images/` + name + `.jpg" class="card-img" alt="` + name + ` pizza">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <form>
                                                    <fieldset disabled>
                                                        <h5 class="card-title">` + name + ` pizza</h5>
                                                        <p class="card-text">` + description + `</p>
                                                        <div class="form-row">
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="size">Size</label>
                                                                    <select class="custom-select custom-select-sm" name="size" required>
                                                                      <option selected>` + size + `</option>
                                                                    </select>
                                                                </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        document.getElementById("divtoChange").insertAdjacentHTML('afterend', '<form action="controller.php?mode=order" method="post"><button class="btn btn-primary" type="submit">Submit Order</button></form>');
                    } // End if
                }; // End anonymous function
            };

            function getOrders() {
                document.getElementById("title").innerHTML = "Orders";
                document.getElementById("divtoChange").innerHTML = "";
                // Get pizzas from database
                var ajax = new XMLHttpRequest();
                ajax.open("GET", "controller.php?mode=orders", true);
                ajax.send();
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var array = JSON.parse(ajax.responseText);
                        for (var index = 0; index < array.length; index++) {
                            var name = array[index]['name'];
                            var size = array[index]['size'];
                            var description = array[index]['description'];
                            document.getElementById("divtoChange").innerHTML += `<div class="col mb-4">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                          <img src="images/` + name + `.jpg" class="card-img" alt="` + name + ` pizza">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <form>
                                                    <fieldset disabled>
                                                        <h5 class="card-title">` + name + ` pizza</h5>
                                                        <p class="card-text">` + description + `</p>
                                                        <div class="form-row">
                                                                <div class="col-md-3 mb-3">
                                                                    <label for="size">Size</label>
                                                                    <select class="custom-select custom-select-sm" name="size" required>
                                                                      <option selected>` + size + `</option>
                                                                    </select>
                                                                </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                    } // End if
                }; // End anonymous function
            };
        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    </body>
</html>
