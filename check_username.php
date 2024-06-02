<?php
include('config.php');
include('register.php');

$username = $_POST['username'];

$query = $connection->prepare("SELECT * FROM users WHERE username=:username");
$query->bindParam("username", $username, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo 'taken';
} else {
    echo 'available';
}
