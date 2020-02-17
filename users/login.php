<?php

$username = $_POST['username'];
$password = $_POST['password'];

if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id`, `email`, `name`, `surname`, `bio` FROM `users` WHERE BINARY `username` = ? AND `password` = ?"))
{
    $stmt -> bind_param("ss", $username, $password);
    $stmt -> execute();
    $stmt -> bind_result($id, $email, $name, $surname, $bio);

    while ($stmt -> fetch())
    {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['bio'] = $bio;
        $_SESSION['password'] = $password;
    }

    $stmt -> close();

    header("Location: " . $GLOBALS['home']);
}

?>
