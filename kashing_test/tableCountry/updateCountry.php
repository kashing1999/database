<!DOCTYPE HTML>
<html>

<head>
    <!-- Errors are red in color -->
    <style>
        .error {
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
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

// Start session
session_start();

include 'includes_country/Config.php';
// Initialize variables
$codeErr = $nameErr = $continentErr = $regionErr = $surfaceAreaErr = $populationErr = $gnpErr = $localNameErr = $governmentFormErr = $code2Err = "";
$code = $name = $continent = $region = $surfaceArea = $indepYear = $population = $lifeExpectancy = $gnp = $gnpold = $localName = $governmentForm = $headOfState = $capital = $code2 = "";
$codeR = $nameR = $continentR = $regionR = $surfaceAreaR = $populationR = $gnpR = $localNameR = $governmentFormR = $code2R = false;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_POST["Code"])) {
        //Let the session variable (wannaSearchCode) be the Country Code that received from select.php 
        $_SESSION['wannaSearchCode'] = $_POST["Code"];
    }

    $sql = "SELECT * FROM country WHERE Code = '" . $_SESSION['wannaSearchCode'] . "'";

    // Stores the result of the query into variable $result1
    $result1 = $conn->query($sql);
}

// Check if Edit button is clicked
// Check if the field is empty
if (isset($_POST["edit"])) {

    if (empty($_POST["u_code"])) {
        $codeErr = "Country code is required.";
    } else {
        $code = sanitize($_POST["u_code"]);
        $codeR = true;
    }
    if (empty($_POST["u_name"])) {
        $nameErr = "Country name is required.";
    } else {
        $name = sanitize($_POST["u_name"]);
        $nameR = true;
    }
    if (empty($_POST["u_continent"])) {
        $continentErr = "Continent is required.";
    } else {
        $continent = sanitize($_POST["u_continent"]);
        $continentR = true;
    }
    if (empty($_POST["u_region"])) {
        $regionErr = "Region is required.";
    } else {
        $region = sanitize($_POST["u_region"]);
        $regionR = true;
    }
    if (empty($_POST["u_surfaceArea"])) {
        $surfaceAreaErr = "Surface area is required.";
    } else {
        $surfaceArea = sanitize($_POST["u_surfaceArea"]);
        $surfaceAreaR = true;
    }
    if (empty($_POST["u_independentYear"])) {
        $indepYear = "";
    } else {
        $indepYear = sanitize($_POST["u_independentYear"]);
    }
    if (empty($_POST["u_population"])) {
        $populationErr = "Population is required.";
    } else {
        $population = sanitize($_POST["u_population"]);
        $populationR = true;
    }
    if (empty($_POST["u_lifeExpectancy"])) {
        $lifeExpectancy = "";
    } else {
        $lifeExpectancy = sanitize($_POST["u_lifeExpectancy"]);
    }
    if (empty($_POST["u_gnp"])) {
        $gnpErr = "GNP is required";
    } else {
        $gnp = sanitize($_POST["u_gnp"]);
        $gnpR = true;
    }
    if (empty($_POST["u_gnpOld"])) {
        $gnpold = "";
    } else {
        $gnpold = sanitize($_POST["u_gnpOld"]);
    }
    if (empty($_POST["u_localName"])) {
        $localNameErr = "Local Name is required.";
    } else {
        $localName = sanitize($_POST["u_localName"]);
        $localNameR = true;
    }
    if (empty($_POST["u_governmentForm"])) {
        $governmentFormErr = "Government Form is required.";
    } else {
        $governmentForm = sanitize($_POST["u_governmentForm"]);
        $governmentFormR = true;
    }
    if (empty($_POST["u_headOfState"])) {
        $headOfState = "";
    } else {
        $headOfState = sanitize($_POST["u_headOfState"]);
    }
    if (empty($_POST["u_capital"])) {
        $capital = "";
    } else {
        $capital = sanitize($_POST["u_capital"]);
    }
    if (empty($_POST["u_code2"])) {
        $code2Err = "Code 2 is required.";
    } else {
        $code2 = sanitize($_POST["u_code2"]);
        $code2R = true;
    }

    // Assign the country code to variable $oldCode 
    $oldCode = $_SESSION['wannaSearchCode'];

    // Call editData function if all the required fields are filled up 
    if ($codeR and $nameR and $continentR and $regionR and $surfaceAreaR and $populationR and $gnpR and $localNameR and $governmentFormR and $code2R === true) {
        editData($oldCode, $code, $name, $continent, $region, $surfaceArea, $indepYear, $population, $lifeExpectancy, $gnp, $gnpold, $localName, $governmentForm, $headOfState, $capital, $code2);
    }
}

// Stores the result of the query into variable $result1
$result1 = $conn->query($sql);
// Stores the result in an array variable $row
$row = $result1->fetch_assoc();

/********        Form        ********/
echo "<div class = 'container'>";
echo "<form method='post' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . ">";
echo "<p><span class= 'error'>* required  field </span></p>";
echo "<span class='error'>* " . $codeErr . "</span>";
echo "Country Code: <input type='text' class='form-control' name='u_code' value='" . $row['Code'] . "'>";
echo "<br>";

echo '<span class="error">* ' . $nameErr . '</span>';
echo "Country Name: <input type='text' class='form-control' name='u_name' value='" . $row["Name"] . "'>";
echo "<br>";

echo '<span class="error">*' . $continentErr . ' </span>';
echo '<label>Continent:</label>';
echo '<select name="u_continent" class="form-control" size="1" value="' . $row["Continent"] . '">';
echo '<option value=" ' . $row["Continent"] . '" selected = "selected">' . $row["Continent"] . '</option>';
echo '<option value="Asia">Asia</option>';
echo '<option value="Europe">Europe</option>';
echo '<option value="North America">North America</option>';
echo '<option value="Africa">Africa</option>';
echo '<option value="Oceania">Oceania</option>';
echo '<option value="Antarctica">Antarctica</option>';
echo '<option value="South America">South America</option>';
echo '</select>';
echo '<br>';

echo '<span class = "error"> * ' . $regionErr . '</span>';
echo 'Region: <input type = "text" class="form-control" name = "u_region" value = "' . $row["Region"] . '">';
echo "<br>";

echo '<span class = "error">* ' . $surfaceAreaErr . '</span>';
echo 'Surface Area:  <input type="text" class="form-control" name="u_surfaceArea" value="' . $row["SurfaceArea"] . '">';
echo "<br>";

echo 'Independent Year:  <input type="text" class="form-control"  name="u_independentYear" value="' . $row["IndepYear"] . '">';
echo "<br>";

echo '<span  class="error">* ' . $populationErr . '</span>';
echo 'Population:  <input type="text" class="form-control" name="u_population" value="' . $row["Population"] . '">';
echo "<br>";

echo 'Life Expectancy:  <input type="text" class="form-control" name="u_lifeExpectancy" value="' . $row["LifeExpectancy"] . '">';
echo "<br>";

echo '<span  class="error">*' . $gnpErr . '</span>';
echo 'GNP:  <input type="text" class="form-control" name="u_gnp" value="' . $row["GNP"] . '">';
echo "<br>";

echo 'GNPOld: <input type  ="text" class="form-control" name="u_gnpOld" value="' . $row["GNPOld"] . '">';
echo "<br>";

echo '<span class = "error">* ' . $localNameErr . '</span>';
echo 'Local Name: <input type= "text" class="form-control" name="u_localName" value="' . $row["LocalName"] . '">';
echo "<br>";

echo '<span class = "error">* ' . $governmentFormErr . '</span>';
echo 'Government Form: <input type="text" class="form-control" name="u_governmentForm" value="' . $row["GovernmentForm"] . '">';
echo "<br>";

echo 'Head of State: <input type="text" class="form-control" name="u_headOfState" value="' . $row["HeadOfState"] . '">';
echo "<br>";

echo 'Capital : <input type="text" class="form-control" name="u_capital" value="' . $row["Capital"] . '">';
echo "<br>";

echo '<span class="error">  *' . $code2Err . '</span>';
echo 'Country Code 2: <input type = "text" class="form-control"  name="u_code2" value= "' . $row["Code2"] . '">';
echo "<br>";

// Edit button
echo '<button name="edit" class="submit-button btn btn-outline-secondary">Edit</button>';
echo '</form>';
// Delete button
echo '<br><form method = "POST" action = "' . htmlspecialchars('selectCountry.php') . '">';
echo '<button name="back" class="submit-button btn btn-outline-secondary">Back</button>';
echo '</form>';
echo "</div>";

// Function that remove blank spaces, remove backslashes and convert special characters to HTML entities
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to update data
function editData($oldCode, $code, $name, $continent, $region, $surfaceArea, $indepYear, $population, $lifeExpectancy, $gnp, $gnpold, $localName, $governmentForm, $headOfState, $capital, $code2)
{
    include 'includes_country/Config.php';
    // Arrays definition
    $fields = array($code, $name, $continent, $region, $surfaceArea, $indepYear, $population, $lifeExpectancy, $gnp, $gnpold, $localName, $governmentForm, $headOfState, $capital, $code2);
    $fieldsString = array("u_code", "u_name", "u_continent", "u_region", "u_surfaceArea", "u_indepYear", "u_population", "u_lifeExpectancy", "u_gnp", "u_gnpold", "u_localName", "u_governmentForm", "u_headOfState", "u_capital", "u_code2");
    $fields1 = array("Code", "Name", "Continent", "Region", "SurfaceArea", "IndepYear", "Population", "LifeExpectancy", "GNP", "GNPOld", "LocalName", "GovernmentForm", "HeadOfState", "Capital", "Code2");

    $sql = "UPDATE country SET ";
    for ($x = 0; $x < 14; $x++) {
        if (!empty($_POST[$fieldsString[$x]])) {
            $sql .= $fields1[$x] . "= '" . $fields[$x] . "', ";
        }
    }
    $sql .= $fields1[14] . "= '" . $fields[14] . "'";
    $sql .= " WHERE Code  = '" . $oldCode . "'";

    // Alert box pops up if query is successfull
    if ($conn->query($sql) == true) {
        echo '<script language= "javascript">';
        echo 'alert("Country Updated.");';
        echo 'window.location= "selectCountry.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Fail to Update Country\n Error: );';
        echo 'window.location= "selectCountry.php"';
        echo '</script>';
    }
}

?>