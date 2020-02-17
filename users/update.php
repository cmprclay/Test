<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$bio = $_POST['bio'];
$id = $_SESSION['id'];

if ($stmt = $GLOBALS['database'] -> prepare("UPDATE `users` SET `username` = ?, `email` = ?, `password` = ?, `name` = ?, `surname` = ?, `bio` = ? WHERE `id` = ?"))
{
    $stmt -> bind_param("ssssssi", $username, $email, $password, $name, $surname, $bio, $id);
    $stmt -> execute();
    $stmt -> close();

    // Update the session variables
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['bio'] = $bio;
    $_SESSION['password'] = $password;

    // Redirect to homepage
    header("Location: " . $GLOBALS['home']);
}

?>
