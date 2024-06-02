<?php
    session_start();
    include('config.php');
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error">Этот адрес уже зарегистрирован!</p>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(username,password,email) VALUES (:username,:password_hash,:email)");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<p class="success">Регистрация прошла успешно!</p>';
            } else {
                echo '<p class="error">Неверные данные!</p>';
            }
        }
    }
?>
<title>Your Home</title>
<link rel="shortcut icon" href="img/Symbol_mini.png">
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" href="stylereg.css">
<body>

    <!--header-->
    <header>
        <a href="home.html" class="logo">
            <img src="img/Symbol.png" alt="Estatein">
        </a>

        <ul class="navbar">
            <li><a href="home_close.html">Home</a></li>
            <li><a href="home_close.html">About Us</a></li>
            <li><a href="home_close.html">Properties</a></li>
            <li><a href="home_close.html">Services</a></li>
            <li><a href="home_close.html">Contact Us</a></li>
        </ul>

        <div class="h-btn">
            <a href="login.php" class="h-btn1">Login</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>
    <br><br><br><br>
<form method="post" action="" name="signup-form">
<div class="form-element">
<label>Username</label>
<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>Email</label>
<input type="email" name="email" required />
</div>
<div class="form-element">
<label>Password</label>
<input type="password" name="password" required />
</div>
<button type="submit" name="register" value="register">Register</button>
</form>

<div class="home-img" data-aos="zoom-in-up">
            <img src="img/handhouse.png">
        </div>
    </section>

     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
     <script>
        AOS.init({
            offset: 300,
            duration: 1200
        });
     </script>



</body>
<script src="script.js"></script>