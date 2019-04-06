<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link rel="stylesheet" type="text/css" href="about.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <!---Bootstrap--->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!---End_Bootstrap--->
    <link rel="stylesheet" type="text/css" href="mynavbar.css">


<style>
body {
    background-image: url("images/newzealand.jpg");
}
</style>

</head>

<body>
   <nav class="navbar navbar-default navbar-fixed-top">
    <div id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php">HOME</a></li>
        <li><a href="about.php">ABOUT</a></li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">CITY
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="tableCity/queryCity.php">Search</a></li>
            <li><a href="tableCity/insertCity.html">Add Record</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">COUNTRY
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="tableCountry/selectCountry.php">Search</a></li>
            <li><a href="tableCountry/insertCountry.php">Add Record</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">LANGUAGE
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <form method="post" action="tableLanguage/language.php" style="margin-bottom: 0;">
              <li><input class="linkLangTable" style="border: none; width: 100%; text-align: left; padding: 5px 20px 5px 20px;" type="submit" name="btnOpenLSearchPage" value="Search"></input></li>
              <li><input class="linkLangTable" style="border: none; width: 100%; text-align: left; padding: 5px 20px 5px 20px; " type="submit" name="btnOpenLAddRecordPage" value="Add Record"></input></li>
            </form>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
    
    <div class = "container about">
        <div class ="about-box">
            <h3>About</h3><br>
            <p>Welcome to World Database. In this database, we present highly detailed information about cities, countries and languages around the world. <br><br>You can <strong>SELECT</strong>, <strong>ADD</strong>, <strong>UPDATE</strong> or <strong>DELETE</strong> any records in each table. <br><br>We hope you enjoy learning more about this database as much fun as we had making it!</p>
    
        </div>
    </div>
</body>
</html>