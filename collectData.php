<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SickSense</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="html5, css3, bootstrap, php, js, firebase">
    <meta name="author" content="Van-Nhan, Jeff, Israel, Kasim, Enock">

    <link rel="shortcut icon" type="image/png" href="sickSense.png">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>

    <br>
      <h1>SickSense</h1>
      <div class="card">
      <div class="card-body">
      <h5 class="card-title">The following data has been entered to the database:</h5>
      <br>
      <form action="index.html" method='post'>

        <?php
          // Connect to the database.
          require("dbLogin.php");
          $db_connection = new mysqli($host, $user, $password, $database);

          // Collect the data provides.
          $building = $_POST["building"];
          $illness = $_POST["illness"];
          $duration = $_POST["duration"];
          $doctor = $_POST["doctor"];
          $date = $_POST['date'];

          // Get the corresponding building code.
          $code = getBuildingCode($db_connection, $building);

          // Calculate the severity score.
          $severity = illnessScore($illness) * durationScore($duration) * verificationScore($doctor);

          // Store the verification as a boolean.
          $verified = ($doctor === 'Yes') ? ("true") : ("false");

          // Store the date as SQL format.
          $first = substr($date, 0, 5);
          $second = substr($date, 6, 10);
          $date = $second.'/'.$first;

          // Insert the record into the database.
          $query = "insert into Records values(".$code.", ".$severity.", '".$illness."', ".$verified.", '".$date."');";
          $db_connection->query($query);

          // Close the connection.
          $db_connection->close();

        ?>


        <center><table border="1">
          <tr>
            <th>Illness</th>
            <th>Building</th>
            <th>Duration of Illness</th>
            <th>Date in Building</th>
            <th>Verified by Doctor</th>
          </tr>

          <tr>
            <?php
              print("<td>".$illness."</td>");
              print("<td>".$building."</td>");
              print("<td>".$duration."</td>");
              print("<td>".$date."</td>");
              print("<td>".$doctor."</td>");
            ?>
          </tr>
        </table> </center>
        <br>

        <button type="submit" class="mainOption btn-primary" name="submit" style="margin: 5px">OK</button>

      </form>
    </div>
  </div>

  </body>
</html>

<?php
  function illnessScore($illness){
    if ($illness === 'Enock-itis'){
      return 2;
    }
    else if ($illness === 'Israel-itis'){
      return 3;
    }
    else if ($illness === 'Jeff-itis'){
      return 4;
    }
    else if ($illness === 'John-itis'){
      return 5;
    }
    else if ($illness === 'Kasim-itis'){
      return 6;
    }
    else {
      return 10;
    }
  }

  function durationScore($duration){
    if ($duration === '1 to 2 Days'){
      return 10;
    }
    else if ($duration === '3 to 4 Days'){
      return 5;
    }
    else{
      return 1;
    }
  }

  function verificationScore($verified){
        if ($verified === 'Yes'){
          return 2;
        }
        else {
          return 1;
        }
  }

  function getBuildingCode($db_connection, $building){
    $query = "select Code from Buildings where name like '%".$building."%';";
    $results = $db_connection->query($query);
    $row = $results->fetch_array(MYSQLI_ASSOC);
    return (int)$row['Code'];
  }
?>
