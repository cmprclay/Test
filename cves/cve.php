<?php

getHeader("CVE Info");

?>

<style type="text/css">
.container {
  position: relative;
  text-align: center;
  color: white;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>

<?php

$id = $_GET['id']; // GET the id values from the URL bar

if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id`, `code`, `score`, `date`, `type`, `complexity`, `description`, `url` FROM `cves` WHERE `id` = " . $id))
{
    $stmt -> execute();
    $stmt -> bind_result($id, $code, $score, $date, $type, $complexity, $description, $url);
    $stmt -> store_result();

    // Loop over the result and print the credentials to the page using "echo"
    while ($stmt -> fetch())
    {
        ?>

        <div class="jumbotron text-center">
          <h1>CVE Database Info</h1>
          <p>Welcome to the LJMU CVE Database Info for Secure Software Development</p>
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

          <div class="row" style="height:100px;">
              <h4 class="text-primary">Info For: <?php echo $code; ?></h4>
          </div>

          <div class="row">

            <section class="row text-center placeholders">
                <div class="col-3 placeholder">
                  <div class="container">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <div class="centered display-4"><?php echo $score; ?></div>
                  </div>
                  <h4 class="text-danger">CVE Score</h4>
                </div>

                <div class="col-3 placeholder">
                  <div class="container">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <div class="centered display-4"><?php echo $type; ?></div>
                  </div>
                  <h4 class="text-danger">Vulnerability Type</h4>
                </div>

                <div class="col-3 placeholder">
                  <div class="container">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <div class="centered display-4"><?php echo $complexity; ?></div>
                  </div>
                  <h4 class="text-danger">Complexity</h4>
                </div>

                <div class="col-3 placeholder">
                  <div class="container">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <div class="centered display-4"><?php echo $id; ?></div>
                  </div>
                  <h4 class="text-danger">Library ID</h4>
                </div>
              </section>
            </div>

            <div class="row" style="margin-top:50px;">
                <h4 class="text-primary">Description:</h4>
                <p class="text-secondary text-left font-weight-bold"><?php echo $description; ?></p>
                <a href="<?php echo $url; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" style="margin-right:10px;">More Info</a>
                <a href="<?php echo $GLOBALS['home']; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Homepage</a>
            </div>
        </div>

        <?php
    }

    $stmt -> free_result();
    $stmt -> close();
}

getFooter();

?>
