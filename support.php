<?php

function generatePage($body) {
    $page = <<<EOPAGE
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
            <center>
              <h5 class="card-title">Filter Databse Entries</h5>
              $body
            </center>
          </div>
        </div>
      </body>

      <!-- JavaScripts -->
      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/script.js"></script>
    </html>
EOPAGE;

    return $page;
}
?>
