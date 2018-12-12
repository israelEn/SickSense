<?php
  require_once("./../support.php");

  $bottomPart = "";
  if (isset($_POST["submit"])) {
    session_start();

    $_SESSION["applications"] = $_POST["applications"];
    $_SESSION["sort"] = $_POST["sort"];
    $_SESSION["filter"] = trim($_POST["filter"]);

    echo gettype($_POST["applications"]);

    header("Location: admin.php");
  }

  $topPart = <<<EOBODY
    <br><form action="{$_SERVER["PHP_SELF"]}" method="post">

      <h2 style="padding-top=15px">Applications</h2>
      <br>

      <b><p>Select fields to display</p></b>
      <select size="4" name="applications[]" multiple required>
        <option value="name">name</option>
        <option value="email">email</option>
        <option value="gpa">gpa</option>
        <option value="year">year</option>
        <option value="gender">gender</option>
      </select>

      <br><br>

      <b>Select field to sort applications</b>
      <select size="1" name="sort" required>
        <option value="name">name</option>
        <option value="email">email</option>
        <option value="gpa">gpa</option>
        <option value="year">year</option>
        <option value="gender">gender</option>
      </select>

      <br><br>

      <p><strong>Filter Condition </strong><input type="text" name="filter"></p>

      <button type="submit" value="Submit" name="submit">Submit Data</button><br>

      <button type="button" name="return" style="margin-top: 15px; margin-bottom: 15px;">
        <a href="main.html" style="text-decoration: none; color: #000;">Return to main menu</a>
      </button>
  	</form>

EOBODY;

  $body = $topPart.$bottomPart;

  $page = generatePage($body);
  echo $page;
?>
