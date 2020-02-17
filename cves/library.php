<?php

header("X-XSS-Protection: 0"); // Disable Chromes built-in XSS prevention

getHeader("CVE Library");

?>

<div class="jumbotron text-center">
  <h1>CVE Database Library</h1>
  <p>Welcome to the LJMU CVE Database Library for Secure Software Development</p>
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
  <div class="row" style="margin-bottom:25px;">
    <div class="col-sm-12">
      <h3>Search For a CSV</h3>
        <form method="POST">
          <div class="form-group">
            <label for="code">CSV Code:</label>
            <input type="code" class="form-control" id="code" name="code">
          </div>
          <button class="btn btn-primary">Search</button>
        </form>
    </div>

    <?php
      if (isset($_POST['code']))
      {
          echo "<p>You searched for: " . $_POST['code'] . "</p>";
      }
     ?>
  </div>

  <div class="row">
    <table class="table table-striped table-dark">

      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">CVE Code</th>
          <th scope="col">Score</th>
          <th scope="col">Date</th>
        </tr>
      </thead>

      <tbody>
        <?php
          if ($stmt = $GLOBALS['database'] -> prepare("SELECT `id`, `code`, `score`, `date` FROM `cves` ORDER BY `id` ASC"))
          {
              $stmt -> execute();
              $stmt -> bind_result($id, $code, $score, $date);
              $stmt -> store_result();

              // Loop over the result and print the credentials to the page using "echo"
              while ($stmt -> fetch())
              {
                echo "<tr id='tableRow-" . $code ."'>
                        <th scope='row'>" . $id ."</th>
                        <td><a href='/cves/cve.php?id=" . $id . "'>" . $code . "</a></td>
                        <td>" . $score . "</td>
                        <td>" . $date . "</td>
                      </tr>";
              }

              $stmt -> free_result();
              $stmt -> close();
          }
        ?>
      </tbody>
    </table>

    <a href="<?php echo $GLOBALS['home']; ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Homepage</a>

  </div>
</div>

<?php

getFooter();

?>

<script type="text/javascript">
$(document).ready(function()
{
    var csvCode = "<?php echo $_POST['code']; ?>";
    $('#tableRow-' + csvCode).css('color', 'red');

    if($('#tableRow-' + csvCode).length > 0)
    {
        alert('That CSV code Exists!');
    }
    else
    {
      alert("That CSV code doesn't exist!");
    }

});
</script>
