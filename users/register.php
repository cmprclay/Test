<?php

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];

if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id` FROM `users` WHERE `username` = ? OR `email` = ?"))
{
    $stmt -> bind_param("ss", $username, $email);
    $stmt -> execute();
    $stmt -> bind_result($id);

    while ($stmt -> fetch())
    {
        echo "Could not create account!";
        die();
    }

    $stmt -> close();
}

if ($stmt = $GLOBALS['database'] -> prepare("INSERT INTO `users` (`username`, `email`, `password`, `ip`) VALUES (?, ?, ?, ?)"))
{
    $stmt -> bind_param("ssss", $username, $email, $password, $ip);
    $stmt -> execute();
    $last_id = $stmt -> insert_id; // The ID of the row just inserted

    // Once the user is logged in, update the user's session variables
    $_SESSION['id'] = $last_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    $stmt -> close();

    // Redirect to homepage
    header("Location: " . $GLOBALS['home']);
}

?>
