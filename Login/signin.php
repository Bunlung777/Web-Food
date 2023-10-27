<?php

session_start();

include("../Config/DB.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($username == $user['username'] && $password == $user['password']) {
            $_SESSION['user_id'] = $user['Iduser'];
            $_SESSION['loginsuccess'] = '';
            header('Location: ../Village/index.php');
        } else {
            $_SESSION['error'] = '';
            header('Location: login.php');
        }
}

?>