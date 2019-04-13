<!DOCTYPE HTML>
<html>

<head>
    <!-- Errors are red in color -->
    <style>
        .required {
            color: #FF0000;
        }
    </style>
    <!---Bootstrap--->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!--End BootStrap-->
    <!-- UTF-8 character set is used for the website -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- To control how website shows up on mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Country</title>
</head>

<body>
    <div class="container">
        <!-- Display 'Edit Country' -->
        <h1 class="display-4">Edit Country</h1>
        <hr>
</body>

</html>

<?php
// Set session cache limiter to false to avoid session expired
include '../mynavbar.php';
include 'includes_country/Config.php';
// Initialize variables

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_POST["Code"])) {
        //Let the session variable (wannaSearchCode) be the Country Code that received from select.php 
        $searchCode = $_POST["Code"];
    }

    $sql = "SELECT * FROM country WHERE Code = '" . $searchCode . "'";

    // Stores the result of the query into variable $result1
    $result1 = $conn->query($sql);

    // Stores the result in an array variable $row
    $row = $result1->fetch_assoc();




    /********        Form        ********/
    echo "<div class = 'container'>";
    echo "<form method='post' action='includes_country/performEdit.php'>";
    echo "<p><span class= 'required'>* required  field </span></p>";
    echo "<span class='required'>* </span>";
    echo "Country Code: <input type='text' class='form-control' name='u_code' value='" . $row['Code'] . "' required>";
    echo "<br>";

    echo '<span class="required">* </span>';
    echo "Country Name: <input type='text' class='form-control' name='u_name' value='" . $row["Name"] . "' required>";
    echo "<br>";

    // Drop down select menu for continent to avoid other inputs
    $cont = $row["Continent"];
    echo '<span class="required">* </span>';
    echo '<label>Continent:</label>';
    echo '<select name="u_continent" class="form-control" size="1">';

    if ($cont == "Asia") {
        echo '<option value="Asia" selected = "selected">Asia</option>';
    } else {
        echo '<option value="Asia">Asia</option>';
    }

    if ($cont == "Europe") {
        echo '<option value="Europe" selected = "selected">Europe</option>';
    } else {
        echo '<option value="Europe">Europe</option>';
    }

    if ($cont == "North America") {
        echo '<option value="North America" selected = "selected">North America</option>';
    } else {
        echo '<option value="North America">North America</option>';
    }

    if ($cont == "Africa") {
        echo '<option value="Africa" selected = "selected">Africa</option>';
    } else {
        echo '<option value="Africa">Africa</option>';
    }

    if ($cont == "Oceania") {
        echo '<option value="Oceania" selected = "selected">Oceania</option>';
    } else {
        echo '<option value="Oceania">Oceania</option>';
    }

    if ($cont == "Antarctica") {
        echo '<option value="Antarctica" selected = "selected">Antarctica</option>';
    } else {
        echo '<option value="Antarctica">Antarctica</option>';
    }

    if ($cont == "South America") {
        echo '<option value="South America" selected = "selected">South America</option>';
    } else {
        echo '<option value="South America">South America</option>';
    }
    echo '</select>';
    echo '<br>';

    echo '<span class = "required"> * </span>';
    echo 'Region: <input type = "text" class="form-control" name = "u_region" value = "' . $row["Region"] . '" required>';
    echo "<br>";

    echo '<span class = "required">* </span>';
    echo 'Surface Area:  <input type="text" class="form-control" name="u_surfaceArea" value="' . $row["SurfaceArea"] . '" required>';
    echo "<br>";

    echo 'Independent Year:  <input type="text" class="form-control"  name="u_independentYear" value="' . $row["IndepYear"] . '">';
    echo "<br>";

    echo '<span  class="required">* </span>';
    echo 'Population:  <input type="text" class="form-control" name="u_population" value="' . $row["Population"] . '" required>';
    echo "<br>";

    echo 'Life Expectancy:  <input type="text" class="form-control" name="u_lifeExpectancy" value="' . $row["LifeExpectancy"] . '">';
    echo "<br>";

    echo '<span  class="required"> * </span>';
    echo 'GNP:  <input type="text" class="form-control" name="u_gnp" value="' . $row["GNP"] . '" required>';
    echo "<br>";

    echo 'GNPOld: <input type  ="text" class="form-control" name="u_gnpOld" value="' . $row["GNPOld"] . '">';
    echo "<br>";

    echo '<span class = "required">* </span>';
    echo 'Local Name: <input type= "text" class="form-control" name="u_localName" value="' . $row["LocalName"] . '" required>';
    echo "<br>";

    echo '<span class = "required">* </span>';
    echo 'Government Form: <input type="text" class="form-control" name="u_governmentForm" value="' . $row["GovernmentForm"] . '" required>';
    echo "<br>";

    echo 'Head of State: <input type="text" class="form-control" name="u_headOfState" value="' . $row["HeadOfState"] . '">';
    echo "<br>";

    echo 'Capital : <input type="text" class="form-control" name="u_capital" value="' . $row["Capital"] . '">';
    echo "<br>";

    echo '<span class="required"> * </span>';
    echo 'Country Code 2: <input type = "text" class="form-control"  name="u_code2" value= "' . $row["Code2"] . '" required>';
    echo "<br>";

    // Edit button
    echo '<button name="edit" class="submit-button btn btn-outline-secondary">Edit</button>';
    echo '<input hidden = "text"  name= "searchCode" value = "' . $searchCode . '">';
    echo '</form>';

    // Delete button
    echo '<br><form method = "POST" action = "' . htmlspecialchars('selectCountry.php') . '">';
    echo '<button name="back" class="submit-button btn btn-outline-secondary">Back</button>';
    echo '</form>';
    echo "</div>";
}
