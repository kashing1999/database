<!DOCTYPE html>
<html>

<head>
    <!-- To control how website shows up on mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="selectCountry.css">
</head>

<body>
    <?php include '../mynavbar.php';?>
    <!-- Select Form -->
    <div class="container">
        <h2 class="display-4">Countries</h2>
        <hr>

        <!-- Form will be passed to this file itself after Search button is clicked -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row">
                <div class="col-md-2 col-sm-3">Country Code: <input type="text" name="s_Code"></div>
                <div class="col-md-2 col-sm-3">Country Name: <input type="text" name="s_Name"></div>
                <div class="col-md-2 col-sm-3">Continent: <input type="text" name="s_Continent"></div>
                <div class="col-md-2 col-sm-3">Local Name: <input type="text" name="s_LocalName"></div>
                <div class="col-md-2 col-sm-3">Country Code 2: <input type="text" name="s_Code2"></div>

                <!-- Search button -->
                <div class="col-md-2 col-sm-3" id="searchbox">
                    <button name="search" class='submit-button btn btn-outline-secondary'>Search</button>
                </div>
            </div>
        </form>


    </div>
</body>

</html>


<!-- PHP codes below , No more HTML-->
<?php 

include 'includes_country/Insert.php';
include 'includes_country/Config.php';


// Initialize variables
$s_Code = $s_Name = $s_Continent = $s_LocalName = $s_Code2 = "";

// If search button is clicked 
// If field is blank ,then variable is empty else call sanitize function
if (isset($_POST["search"])) {

    $searchButtonTriggered = 1;

    if (empty($_POST["s_Code"])) {
        $s_Code = "";
    } else {
        $s_Code = sanitize($_POST["s_Code"]);
    }

    if (empty($_POST["s_Name"])) {
        $s_Name = "";
    } else {
        $s_Name = sanitize($_POST["s_Name"]);
    }

    if (empty($_POST["s_Continent"])) {
        $s_Continent = "";
    } else {
        $s_Continent = sanitize($_POST["s_Continent"]);
    }

    if (empty($_POST["s_LocalName"])) {
        $s_LocalName = "";
    } else {
        $s_LocalName = sanitize($_POST["s_LocalName"]);
    }

    if (empty($_POST["s_Code2"])) {
        $s_Code2 = "";
    } else {
        $s_Code2 = sanitize($_POST["s_Code2"]);
    }
    // Call selectData function (Insert.php) after the checking
    selectData($s_Code, $s_Name, $s_Continent, $s_LocalName, $s_Code2);
} else {

    // Display all the data when entering the search page
    selectData($s_Code, $s_Name, $s_Continent, $s_LocalName, $s_Code2);
}



// Function that remove blank spaces, remove backslashes and convert special characters to HTML entities
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?> 