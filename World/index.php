<!DOCTYPE html>
<html lang="en">

<head>
  <title>World Database</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!---Bootstrap--->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <!--End BootStrap-->
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="mynavbar.css">
</head>

<body>

  <div class="jumbotron">
    <h1>Welcome to</h1>
    <h2>World Database</h2>
  </div>


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
            <li><a href="tableCity/insertCity.php">Add Record</a></li>
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

  <!--SlideShow-->
  <div class="container" style="width: 100%;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">

        <div class="item active">
          <img src="images/newzealand.jpg" alt="City" style="width:100%;">
          <div class="carousel-caption">
            <h3>Country</h3>
          </div>
        </div>

        <div class="item">
          <img src="images/purplesky.jpg" alt="Country" style="width:100%;">
          <div class="carousel-caption">
            <h3>City</h3>
          </div>
        </div>

        <div class="item">
          <img src="images/amsterdam.jpg" alt="Language" style="width:100%;">
          <div class="carousel-caption">
            <h3>Language</h3>
          </div>
        </div>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

</body>

</html>