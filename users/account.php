<?php

getHeader("Account Overview");

if (!isset($_SESSION['id']))
{
    echo "<img src='noentry.jpg'><br><br>";
    echo "<h1>This is a members only area. Please Login.</h1>";
    die();
}

?>

<div class="jumbotron text-center">
  <h1>Account Overview</h1>
  <p>Welcome to the LJMU CVE Database Account Overview for Secure Software Development</p>
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
      <h3>Edit User Info</h3>
        <form method="POST">

          <div class="form-group">
            <label for="username">Username:</label>
            <input type="username" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
          </div>

          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
          </div>

          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $_SESSION['password']; ?>">
          </div>

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="name" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name']; ?>">
          </div>

          <div class="form-group">
            <label for="surname">Surname:</label>
            <input type="surname" class="form-control" id="surname" name="surname" value="<?php echo $_SESSION['surname']; ?>">
          </div>

          <div class="form-group">
            <label for="bio">Bio:</label>
            <input type="bio" class="form-control" id="bio" name="bio" value="<?php echo $_SESSION['bio']; ?>">
          </div>

          <button style="margin-right:10px;" class="btn btn-primary" formaction="/users/update.php">Update</button>
          <a href="<?php echo $GLOBALS['home']; ?>" class="btn btn-secondary btn active" role="button" aria-pressed="true">Homepage</a>
        </form>
    </div>
  </div>
</div>

<?php

getFooter();

?>
