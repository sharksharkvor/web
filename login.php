<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">Неверные пароль или имя пользователя!</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id'] = $result['id'];
                echo '<p class="success">Поздравляем, вы прошли авторизацию!</p>';
            } else {
                echo '<p class="error"> Неверные пароль или имя пользователя!</p>';
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
            <a href="register.php" class="h-btn2">Sign Up</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>
    <br><br>
<form method="post" action="" name="signin-form">
  <div class="form-element" data-aos="zoom-in-up">
    <label>Username</label>
    <input type="text" name="username" id="username" pattern="[a-zA-Z0-9]+" required />
  </div>
  <div id="msgbox" class="messagebox"></div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Log In</button>
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