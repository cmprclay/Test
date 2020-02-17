<?php

getHeader("CVE Database");

?>

<style type="text/css">
  body {
    background-color: #SDADE2;
  }
  

<div class="jumbotron text-center">
  <h1>CVE Database Homepage</h1>
  <p>Welcome to the LJMU CVE Database Homepage for Secure Software Development</p>
  <p>Logged in as: <?php

    if (isset($_SESSION['id']))
    {
      echo $_SESSION['username'] . " (" . $_SESSION['email'] . ")";
    }
    else
    {
      echo "Guest";
    }

   ?></p>
</div>

<div class="container">
  <div class="row">

    <div class="col-sm-4">
      <h3>Recent Users</h3>
      <?php
        // Retrieves the last 15 usernames & email addresses from the database, ordered by the id field
        if ($stmt = $GLOBALS['database'] -> prepare("SELECT `username`, `email` FROM `users` ORDER BY `id` DESC LIMIT 15"))
        {
            $stmt -> execute();
            $stmt -> bind_result($username, $email);
            $stmt -> store_result();

            // Loop over the result and print the credentials to the page using "echo"
            while ($stmt -> fetch())
            {
              echo "<p>" . $username . " (" . $email . ")" . "</p>";
            }

            $stmt -> free_result();
            $stmt -> close();
        }
      ?>
    </div>

    <div class="col-sm-4">
      <h3>Top 5 CVEs</h3>
      <?php
        // Retrieves the last 5 CVE entries from the database, ordered by the score field
        if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id`, `code`, `score` FROM `cves` ORDER BY `score` DESC LIMIT 5"))
        {
            $stmt -> execute();
            $stmt -> bind_result($id, $code, $score);
            $stmt -> store_result();

            // Loop over the result and print the credentials to the page using "echo"
            while ($stmt -> fetch())
            {
              echo "<p>" . $code . " (" . $score . ")" . "</p>";
            }

            $stmt -> free_result();
            $stmt -> close();
        }
      ?>

      <a href="/cves/library.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">View CVE Library</a>
    </div>

    <div class="col-sm-4">
      <h3>Create New User</h3>
        <form method="POST" onkeydown="return event.key != 'Enter';"> <!-- Prevents submitting form on [ENTER] -->

          <div class="form-group">
            <label for="username">Username:</label>
            <input type="username" class="form-control" id="username" name="username">
          </div>

          <div class="form-group">
            <label for="email">Email address: (not required for login)</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <!-- There are several default colours in Bootstrap CSS accessed by calling the class
               See: https://getbootstrap.com/docs/4.0/utilities/colors/#color -->
          <button class="btn btn-primary" formaction="/users/register.php">Register</button>
          <button class="btn btn-primary" formaction="/users/login.php">Login</button>
          <button class="btn btn-primary" formaction="/users/logout.php">Logout</button>
          <button class="btn btn-primary" formaction="/users/account.php">Account</button>
        </form>
    </div>
  </div>
</div>

<?php

getFooter();

?>
