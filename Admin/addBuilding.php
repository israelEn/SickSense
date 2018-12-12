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
  <body>

    <br>
    <h1>SickSense</h1>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Adding Results</h5>

        <form action="adminOptions.html" method='post'>

          <?php
            require("../dbLogin.php");
            $db_connection = new mysqli($host, $user, $password, $database);
            if ($db_connection->connect_error) {
              echo "<b>ERROR: Connection to database failed</b>";
              die($db_connection->connect_error);
            }

            $codeConfirm;
            $code = $_POST["buildingCode"];
            $name = $_POST["buildingName"];
            $initials = strtoupper($_POST["initials"]);


            $in = "select Code from Buildings where Code='$code'";
            $uniqueCode = $db_connection->query($in);


            $num_rows = $uniqueCode->num_rows;
            if ($num_rows != 0) {
              for ($row_index = 0; $row_index < $num_rows; $row_index++) {
                $uniqueCode->data_seek($row_index);
                $row = $uniqueCode->fetch_array(MYSQLI_ASSOC);
              }
            }

            // Insert the new building into the database.
            $input = "$code,'$initials', '$name'";
            $query = "insert into Buildings values ($input)";
            $result = $db_connection->query($query);

            if ($num_rows != 0 && $row['Code'] == $code) {
              echo "<b>ERROR: Building Code is not unique. Building could not be added to the database.</b><br>";
            } else if (!$result) {
              echo "<b>ERROR: Failed to add building</b><br>";
            } else {
              echo "The following building has been added to the database:<br><br>";
              echo "<center><table border='1'>";
              echo "<tr><th>Building Code</th><th>Building Name</th><th>Initials</th></tr><tr>";
              print("<td>".$code."</td>");
              print("<td>".$name."</td>");
              print("<td>".$initials."</td>");
              echo "</tr></table></center><br>";
            }

            // Close the connection.
            $db_connection->close();
          ?>

          <button type="submit" class="mainOption btn-primary" name="submit" style="margin: 5px">OK</button>

        </form>
      </div>
    </div>
  </body>
</html>
