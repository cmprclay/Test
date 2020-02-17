<?php

$email = $_POST['email'];
$password = $_POST['psw'];
$repeat = $_POST['psw-repeat'];

if (strlen($email) < 1 || strlen($email) > 100)
{
    if (strlen($email) < 1)
      echo "Email length too short";
    else
      echo "Email length too long";

      exit();
}
else if (strpos($email, '@') == false)
{
  echo "Email syntax invalid";
  exit();
}
else if (strlen($password) < 8)
{
    echo "Password length too short!";
    exit();
}
else if ($password !== $repeat)
{
  echo "Your passwords don't match!";
  exit();
}

$hash = password_hash($password, PASSWORD_DEFAULT);

?>
