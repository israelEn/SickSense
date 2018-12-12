<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SickSense</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="html5, css3, bootstrap, php, js, firebase">
    <meta name="author" content="Van-Nhan, Jeff, Israel, Kasim, Enock">

    <link rel="shortcut icon" type="image/png" href="../sickSense.png">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
  </head>

  <div class="container-fluid">
    <body>

      <?php
        require_once "./../dbLogin.php";

        $db_connection = new mysqli($host, $user, $password, $database);
        if ($db_connection->connect_error) {
          echo "<b>ERROR: Connection to database failed</b>";
          die($db_connection->connect_error);
        }

        session_start();
        echo "<br>";

        $applications = $_SESSION["applications"];
        $sort = $_SESSION["sort"];
        $filter = trim($_SESSION["filter"]);

        $filterStr = "";

        foreach ($applications as $application) {
          $filterStr = $filterStr.$application.",";
        }

        $filterStr = rtrim($filterStr,",");


        $query = "select ".$filterStr." from applicants";

        if ($filter != "") {
          $query = $query." where ".$filter;
        }

        $query = $query." order by ".$sort;

        //echo $query;

        $result = $db_connection->query($query);

        $num_rows = $result->num_rows;
        if ($num_rows === 0) {
          echo "Empty Table<br>";
        } else {
            for ($row_index = 0; $row_index < $num_rows; $row_index++) {
              $result->data_seek($row_index);
              $row = $result->fetch_array(MYSQLI_ASSOC);
              //echo "email: {$row['email']}, gpa: {$row['gpa']}, year: {$row['year']} <br>";
            }
        }
        //echo "<br><br><br>";
      ?>

      <table class="table table-striped table-border" align="center">
        <thead class="thead-light">
          <tr>
            <?php
              foreach ($applications as $application) {
                echo "<th><center>$application</center></th>";
                //<th scope="col"><center>Software</center></th>
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
            $num_rows = $result->num_rows;
            if ($num_rows === 0) {
              echo "Empty Table<br>";
            } else {

                $length = count($applications);
                $counter = 0;
                for ($row_index = 0; $row_index < $num_rows; $row_index++) {
                  $result->data_seek($row_index);
                  $row = $result->fetch_array(MYSQLI_ASSOC);
                  echo "<tr>";

                  for ($i = 0; $i < $length; $i++) {
                    $temp = $applications[$counter++];
                    echo "<td><center>$row[$temp]</center></td>";
                  }
                  $counter = 0;
                  echo "</tr>";
                }
            }

      		?>
        </tbody>
      </table>

      <button type="button" name="return" style="margin-top: 15px; margin-bottom: 15px;">
        <a href="./../main.html" style="text-decoration: none; color: #000;">Return to main menu</a>
      </button>

    </body>
  </div>

</html>
