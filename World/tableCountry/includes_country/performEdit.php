 <?php
    include 'Config.php';
    // Arrays definition

    $fieldsString = array("u_code", "u_name", "u_continent", "u_region", "u_surfaceArea", "u_independentYear", "u_population", "u_lifeExpectancy", "u_gnp", "u_gnpOld", "u_localName", "u_governmentForm", "u_headOfState", "u_capital", "u_code2");
    $fields1 = array("Code", "Name", "Continent", "Region", "SurfaceArea", "IndepYear", "Population", "LifeExpectancy", "GNP", "GNPOld", "LocalName", "GovernmentForm", "HeadOfState", "Capital", "Code2");

    // Set query if using POST request method
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $sql = "UPDATE country SET ";
        for ($x = 0; $x < 14; $x++) {
            $sql .= $fields1[$x] . "= '" . $_POST[$fieldsString[$x]] . "', ";
        }
        $sql .= $fields1[14] . "= '" . $_POST[$fieldsString[14]] . "'";
        $sql .= " WHERE Code  = '" . $_POST["searchCode"] . "';";

        // Alert box pops up if query is successfull
        if ($conn->query($sql) == true) {
            echo '<script language= "javascript">';
            echo 'alert("Country Updated.");';
            echo 'window.location= "../selectCountry.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Fail to Update Country\n Error: );';
            echo 'window.location= "../updateCountry.php"';
            echo '</script>';
        }
    }
