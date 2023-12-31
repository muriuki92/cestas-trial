<?php include('header.php');
session_start();
include 'dbcon.php';
$sql = mysqli_query($dbconn, "SELECT * FROM signup");


if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $contact = $_POST['contact'];

    $connect = "INSERT signup(username, email, password, contact) VALUES ('$username','$email','$password','$contact')";
    $query = mysqli_query($dbconn, $connect);

    if ($query) {
        echo '<script>alert("SignUp Successfully")</script>';
        header("Refresh: 1; url=index.php");


        $_SESSION['contact'] = $contact;
        $_SESSION['loggedIn'] = true;
    } else {
        echo '<script>alert("Submission Failed!")</script>';
    }
}
?>
<?php
// ... your existing code ...

if (isset($_POST['login'])) {
    $login_email = $_POST['login_email'];
    $login_password = sha1($_POST['login_password']);

    $query = "SELECT * FROM signup WHERE email='$login_email' AND password='$login_password'";
    $result = mysqli_query($dbconn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Valid credentials, retrieve the contact from the database
        $row = mysqli_fetch_assoc($result);
        $contact = $row['contact'];
        $email = $row['email'];

        // Set session cookies and redirect to cart.php

        $_SESSION['contact'] = $contact;
        $_SESSION['email'] = $email;
        $_SESSION['loggedIn'] = true;

        header("Location: cart.php");
        exit(); // Make sure to exit after redirecting
    } else {
        // Invalid credentials, show JavaScript popup
        echo '<script>alert("Invalid credentials")</script>';
    }
}
?>


<link rel="stylesheet" href="style.css">
<style>
    .sign_up {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        margin-top: 10px;
    }

    .sign_up .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .sign_up h1 {
        margin-top: 0;
        margin-bottom: 10px;
    }

    .sign_up .text-muted {
        font-size: 14px;
    }

    .sign_up .form-control {
        margin-bottom: 10px;
    }

    .sign_up .form-group {
        text-align: center;
    }

    input {
        width: 350px;
        height: 40px;
        padding: 0px 0px 0px 17px;
    }

    .tab {
        display: none;
    }

    .tab.active {
        display: block;
    }

    .tab-content {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        margin-top: 10px;
    }

    .tab-buttons {
        text-align: center;
        margin-top: 10px;
    }

    .tab-buttons button {
        padding: 10px 20px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>

<body>
    <!--header section starts-->
    <header>
        <div class="header-1">
            <a href="#" style="" class="logo"><i class="fa-solid fa-basket-shopping"></i></i>Cesta- Sign Up</a>
            <form action="" class="search-box-container">

            </form>
        </div>
        <!--header 2-->

        <div class="header-2 " style="width: 1360px;">

            <div id="menu-bar" class="fa-sharp fa-solid fa-bars"></div>
            <nav class="navbar">
                <a href="index.php" style="" class="nav-link active">Home</a>
                <a href="#category" style="" class="nav-link active">Category</a>
                <a href="#product" style="" class="nav-link active">Product</a>
                <a href="contactus.php" style="" class="nav-link active">Contact</a>
                <a href="admin.php" style="" class="nav-link active">Admin</a>
            </nav>

            <div class="icons">
                <a href="cart.php" class="fa-sharp fa-solid fa-cart-shopping">
                    <?php
                    $countSql = "SELECT COUNT(*) AS total_items FROM cart";
                    $results = mysqli_query($dbconn, $countSql);

                    $rows = mysqli_fetch_assoc($results);
                    $totalItems = $rows['total_items'];
                    echo '<span style="color: #2c2c54;   font-size: 15px; margin-top: 50px; border-radius: 50%;">' . $totalItems . '</span>';
                    ?>
                </a>
                <?php

                if (isset($_SESSION['loggedIn'])) {

                } else {

                    echo '<a href="signup.php" class="fa-sharp fa-solid fa-circle-user"></a>';
                }
                ?>
            </div>
        </div>

    </header>
    <!--header section ends-->


    <div class="tab-buttons">
        <button class="tab-button active" onclick="showTab('signup-tab')">Sign Up</button>
        <button class="tab-button" onclick="showTab('login-tab')">Login</button>
    </div>

    <div class="tab-content">
        <div id="signup-tab" class="tab active">

            <form method="post" action="signup.php" class="sign_up">
                <div class="logo">
                    <h1><a href=" " class="navbar-brand">Sign Up</a></h1>
                    <span class="text-muted">WELCOME TO CESTA</span>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <input type="text" name="username" placeholder="Username" class="form-control" required>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-lg-12">
                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-lg-12">
                        <input type="text" value="254" name="contact" id="contactInput" placeholder="Contact"
                            class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="signup" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <div id="login-tab" class="tab">
            <form method="post" action="signup.php">
                <!-- Your login form inputs here -->
                <div class="row pt-2">
                    <div class="col-lg-12">
                        <input type="email" name="login_email" placeholder="Email" class="form-control" required>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-lg-12">
                        <input type="password" name="login_password" placeholder="Password" class="form-control"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Get the input element
        var contactInput = document.getElementById("contactInput");

        // Add event listener for input event
        contactInput.addEventListener("input", function (event) {
            var input = event.target.value;

            // Remove any non-digit characters
            var digitsOnly = input.replace(/\D/g, "");

            // Restrict the length to 9 characters
            var trimmedValue = digitsOnly.slice(0, 12);

            // Prepend "254" to the trimmed value
            var contactValue = trimmedValue;

            // Update the input value
            event.target.value = contactValue;
        });
    </script>





    <script>
        // JavaScript to handle tab switching
        function showTab(tabName) {
            const tabs = document.getElementsByClassName('tab');
            const tabButtons = document.getElementsByClassName('tab-button');

            for (let i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }

            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }

            const tabToShow = document.getElementById(tabName);
            tabToShow.classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
    <script src="js/script.js"></script>
    <script src="bootstrap-5.3.0-alpha1-dist/bootstrap.min.js"></script>
</body>

</html>