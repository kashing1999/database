<!-- Errors are red in color -->
<style>
    .error {
        color: #FF0000;
    }
</style>

<!DOCTYPE html>
<html>

<head>
    <!-- To control how website shows up on mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insert New Country</title>
</head>

<?php
include_once "includes_country/Insert.php";

// Initialize variables
$codeErr = $nameErr = $continentErr = $regionErr = $surfaceAreaErr = $populationErr = $gnpErr = $localNameErr = $governmentFormErr = $code2Err = "";
$code = $name = $continent = $region = $surfaceArea = $indepYear = $population = $lifeExpectancy = $gnp = $gnpold = $localName = $governmentForm = $headOfState = $capital = $code2 = "";
$codeR = $nameR = $continentR = $regionR = $surfaceAreaR = $populationR = $gnpR = $localNameR = $governmentFormR = $code2R = false;

// Check if submit button is clicked
// Check if the field is empty
if (isset($_POST["submit"])) {
    if (empty($_POST["code"])) {
        $codeErr = "Country code is required.";
    } else {
        $code = sanitize($_POST["code"]);
        $codeR = true;
    }
    if (empty($_POST["name"])) {
        $nameErr = "Country name is required.";
    } else {
        $name = sanitize($_POST["name"]);
        $nameR = true;
    }
    if (empty($_POST["continent"])) {
        $continentErr = "Continent is required.";
    } else {
        $continent = sanitize($_POST["continent"]);
        $continentR = true;
    }
    if (empty($_POST["region"])) {
        $regionErr = "Region is required.";
    } else {
        $region = sanitize($_POST["region"]);
        $regionR = true;
    }
    if (empty($_POST["surfaceArea"])) {
        $surfaceAreaErr = "Surface area is required.";
    } else {
        $surfaceArea = sanitize($_POST["surfaceArea"]);
        $surfaceAreaR = true;
    }
    if (empty($_POST["independentYear"])) {
        $indepYear = "";
    } else {
        $indepYear = sanitize($_POST["independentYear"]);
    }
    if (empty($_POST["population"])) {
        $populationErr = "Population is required.";
    } else {
        $population = sanitize($_POST["population"]);
        $populationR = true;
    }
    if (empty($_POST["lifeExpectancy"])) {
        $lifeExpectancy = "";
    } else {
        $lifeExpectancy = sanitize($_POST["lifeExpectancy"]);
    }
    if (empty($_POST["gnp"])) {
        $gnpErr = "GNP is required";
    } else {
        $gnp = sanitize($_POST["gnp"]);
        $gnpR = true;
    }
    if (empty($_POST["gnpOld"])) {
        $gnpold = "";
    } else {
        $gnpold = sanitize($_POST["gnpOld"]);
    }
    if (empty($_POST["localName"])) {
        $localNameErr = "Local Name is required.";
    } else {
        $localName = sanitize($_POST["localName"]);
        $localNameR = true;
    }
    if (empty($_POST["governmentForm"])) {
        $governmentFormErr = "Government Form is required.";
    } else {
        $governmentForm = sanitize($_POST["governmentForm"]);
        $governmentFormR = true;
    }
    if (empty($_POST["headOfState"])) {
        $headOfState = "";
    } else {
        $headOfState = sanitize($_POST["headOfState"]);
    }
    if (empty($_POST["capital"])) {
        $capital = "";
    } else {
        $capital = sanitize($_POST["capital"]);
    }
    if (empty($_POST["code2"])) {
        $code2Err = "Code 2 is required.";
    } else {
        $code2 = sanitize($_POST["code2"]);
        $code2R = true;
    }

    // Call insertData function in 'Insert.php' if all the required fields are filled up 
    if ($codeR and $nameR and $continentR and $regionR and $surfaceAreaR and $populationR and $gnpR and $localNameR and $governmentFormR and $code2R === true) {
        insertData($code, $name, $continent, $region, $surfaceArea, $indepYear, $population, $lifeExpectancy, $gnp, $gnpold, $localName, $governmentForm, $headOfState, $capital, $code2);
    }
}

// Function that remove blank spaces, remove backslashes, convert special characters to HTML entities and add slashes to quotes to avoid SQL injections
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}
?>

<body>
    <?php include '../mynavbar.php'; ?>
    <!-- Insert Form -->
    <div class="container">
        <br>
        <h1 class="display-4">Insert into Country</h1>
        <hr>
        <p><span class="error">* required field</span></p>

        <!-- Form will be passed to this file itself after Submit button is clicked -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <span class="error">* <?php echo $codeErr; ?></span>
            Country Code: <input type="text" class="form-control" name="code" value="<?php echo $code; ?>">
            <br>

            <span class="error">* <?php echo $nameErr; ?></span>
            Country Name: <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            <br>

            <span class="error">* <?php echo $continentErr; ?></span>
            <label>Continent:</label>

            <!-- Drop down select menu for continent to avoid other inputs -->
            <select name="continent" class="form-control" size="1" value="<?php echo $continent; ?>">
                <?php

                if ($continent == "") {
                    echo '<option value="" selected disabled hidden>Choose here</option>';
                }

                if ($continent == "Asia") {
                    echo '<option value="Asia" selected = "selected">Asia</option>';
                } else {
                    echo '<option value="Asia">Asia</option>';
                }

                if ($continent == "Europe") {
                    echo '<option value="Europe" selected = "selected">Europe</option>';
                } else {
                    echo '<option value="Europe">Europe</option>';
                }

                if ($continent == "North America") {
                    echo '<option value="North America" selected = "selected">North America</option>';
                } else {
                    echo '<option value="North America">North America</option>';
                }

                if ($continent == "Africa") {
                    echo '<option value="Africa" selected = "selected">Africa</option>';
                } else {
                    echo '<option value="Africa">Africa</option>';
                }

                if ($continent == "Oceania") {
                    echo '<option value="Oceania" selected = "selected">Oceania</option>';
                } else {
                    echo '<option value="Oceania">Oceania</option>';
                }

                if ($continent == "Antarctica") {
                    echo '<option value="Antarctica" selected = "selected">Antarctica</option>';
                } else {
                    echo '<option value="Antarctica">Antarctica</option>';
                }

                if ($continent == "South America") {
                    echo '<option value="South America" selected = "selected">South America</option>';
                } else {
                    echo '<option value="South America">South America</option>';
                }
                ?>
            </select>
            <br>

            <span class="error">* <?php echo $regionErr; ?></span>
            Region: <input type="text" class="form-control" name="region" value="<?php echo $region; ?>">
            <br>

            <span class="error">* <?php echo $surfaceAreaErr; ?></span>
            Surface Area: <input type="text" class="form-control" name="surfaceArea" value="<?php echo $surfaceArea; ?>">
            <br>

            Independent Year: <input type="text" class="form-control" name="independentYear" value="<?php echo $indepYear; ?>">
            <br>

            <span class="error">* <?php echo $populationErr; ?></span>
            Population: <input type="text" class="form-control" name="population" value="<?php echo $population; ?>">
            <br>

            Life Expectancy: <input type="text" class="form-control" name="lifeExpectancy" value="<?php echo $lifeExpectancy; ?>">
            <br>

            <span class="error">* <?php echo $gnpErr; ?></span>
            GNP: <input type="text" class="form-control" name="gnp" value="<?php echo $gnp; ?>">
            <br>

            GNPOld: <input type="text" class="form-control" name="gnpOld" value="<?php echo $gnpold; ?>">
            <br>

            <span class="error">* <?php echo $localNameErr; ?></span>
            Local Name: <input type="text" class="form-control" name="localName" value="<?php echo $localName; ?>">
            <br>

            <span class="error">* <?php echo $governmentFormErr; ?></span>
            Government Form: <input type="text" class="form-control" name="governmentForm" value="<?php echo $governmentForm; ?>">
            <br>

            Head of State: <input type="text" class="form-control" name="headOfState" value="<?php echo $headOfState; ?>">
            <br>

            Capital: <input type="text" class="form-control" name="capital" value="<?php echo $capital; ?>">
            <br>

            <span class="error">* <?php echo $code2Err; ?></span>
            Country Code 2: <input type="text" class="form-control" name="code2" value="<?php echo $code2; ?>">
            <br>
            <!-- Submit button -->
            <button name="submit" class='submit-button btn btn-outline-secondary'>Submit</button>

        </form>
        <!-- Head to Table Page (select.php) if Back button is clicked -->
        <form method="POST" action="<?php echo htmlspecialchars('../index.php'); ?>">
            <!-- Back button -->
            <button name="back" class='submit-button btn btn-outline-secondary'>Back</button>
        </form>
    </div>
</body>

</html>