<!DOCTYPE HTML>
<html>

<head>
    <!-- Table Definition  -->
    <style>
        table,
        th,
        td {
            border: none;
            border-collapse: collapse;
            margin: 40px 40px 20px;


        }

        tr {}

        th {
            padding: 10px;
        }

        table {
            margin-left: 40px;
        }

        .pagination {
            justify-content: center;

        }

        .a {
            text-align: center;

        }

        .disabled {
            text-align: center;

        }
    </style>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>

</html>


<?php

// Function that inserts data
function insertData($code, $name, $continent, $region, $surfaceArea, $indepYear, $population, $lifeExpectancy, $gnp, $gnpold, $localName, $governmentForm, $headOfState, $capital, $code2)
{
    include 'Config.php';

    $sql = "INSERT INTO country VALUES ('$code', '$name', '$continent', '$region', '$surfaceArea', '$indepYear', '$population', '$lifeExpectancy', '$gnp', '$gnpold', '$localName', '$governmentForm', '$headOfState', '$capital', '$code2' );";

    // Alert box pops up if query is successfull
    if ($conn->query($sql) == true) {
        echo '<script language="javascript">';
        echo 'alert("Country successfully added.");';
        echo 'window.location= "../index.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Fail to add new country.\n Error: );';
        echo '</script>';
    }
}

// Function that search for data
function selectData($s_Code, $s_Name, $s_Continent, $s_LocalName, $s_Code2)
{

    include 'Config.php';
    // Arrays definition
    $fields = array($s_Code, $s_Name, $s_Continent, $s_LocalName, $s_Code2);
    $fieldsString = array('s_Code', 's_Name', 's_Continent', 's_LocalName', 's_Code2');
    $fields1 = array("Code", "Name", "Continent", "LocalName", "Code2");

    // Count total rows for all data if search fields are all empty else totals rows for selected data
    if (emptyField()) {
        $total_pages_sql = "SELECT COUNT(*) as count FROM country;";
    } else {
        $total_pages_sql = "SELECT COUNT(*) as count FROM country WHERE ";
        for ($x = 0; $x < 5; $x++) {
            if (!empty($_GET[$fieldsString[$x]])) {
                $total_pages_sql .= $fields1[$x] . "='" . $fields[$x] . "' AND ";
            }
        }
        $total_pages_sql .= "true;";
    }

    $result = $conn->query($total_pages_sql);
    $row = ($result->fetch_assoc());
    $total_rows = $row["count"];
    // Limit the total results per page
    $no_of_records_per_page = 30;
    // Round up the total pages
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    // Default is page 1 if page no. is not set
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $offset = ($pageno - 1) * $no_of_records_per_page;



    // Display the whole table if all fields are empty
    if (emptyField()) {
        $sql = "SELECT * FROM country LIMIT $offset, $no_of_records_per_page;";
    } else {
        $sql = "SELECT * FROM country WHERE ";
        for ($x = 0; $x < 5; $x++) {
            if (!empty($_GET[$fieldsString[$x]])) {
                $sql .= $fields1[$x] . "='" . $fields[$x] . "' AND ";
            }
        }
        $sql .= "true ";
        $sql .= "LIMIT $offset, $no_of_records_per_page";
    }



    // Stores the result of the query into variable $result
    $result = $conn->query($sql);

    // Call function to print the table headers
    printHeader();

    if ($result->num_rows >= 0) {

        // Print all the results    
        while ($row = $result->fetch_assoc()) {

            // Let the Country Code of current row as "wannaSearchCode"
            $wannaSearchCode = $row['Code'];
            /********        Table        ********/

            echo "<tr>";
            echo "<td>" . $row['Code'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Continent'] . "</td>";
            echo "<td>" . $row['Region'] . "</td>";
            echo "<td>" . $row['SurfaceArea'] . "</td>";
            echo "<td>" . $row['IndepYear'] . "</td>";
            echo "<td>" . $row['Population'] . "</td>";
            echo "<td>" . $row['LifeExpectancy'] . "</td>";
            echo "<td>" . $row['GNP'] . "</td>";
            echo "<td>" . $row['GNPOld'] . "</td>";
            echo "<td>" . $row['LocalName'] . "</td>";
            echo "<td>" . $row['GovernmentForm'] . "</td>";
            echo "<td>" . $row['HeadOfState'] . "</td>";
            echo "<td>" . $row['Capital'] . "</td>";
            echo "<td>" . $row['Code2'] . "</td>";

            // Defines Edit button
            // Jump to update.php if Edit button is clicked
            $editButton = '<td><form action="updateCountry.php" method = "POST">';
            $editButton .= "<button type = 'Edit' class = 'submit-button btn btn-outline-secondary' name = 'Edit' value = '.$wannaSearchCode.'>edit</button>";
            $editButton .= '<input type = "hidden"  name= "Code" value = "' . $wannaSearchCode . '">';
            $editButton .= "<td></form></td>";

            // Defines Delete button
            // Jump to delete.php if Delete button is clicked
            $deleteButton = '<td><form action="deleteCountry.php" method = "POST">';
            $deleteButton .= "<button type = 'Edit' class = 'submit-button btn btn-outline-secondary' name = 'Delete' value = '.$wannaSearchCode.'>delete</button>";
            $deleteButton .= '<input type = "hidden"  name= "Code" value = "' . $wannaSearchCode . '">';
            $deleteButton .= "<td></form></td>";

            echo $editButton;
            echo $deleteButton;
        }
        echo "</tr>";
    }
    echo "</table>";

    /********        Pagination        ********/

    echo '<ul class="pagination">';
    echo '<li><a href="?pageno=1';
    echo "&s_Code=$s_Code&s_Name=$s_Name&s_Continent=$s_Continent&s_LocalName=$s_LocalName&s_Code2=$s_Code2&search=";
    echo '"><< First &nbsp;&nbsp;</a></li>';

    if ($pageno <= 1) {

        echo '<li class="disabled"} ">';
        echo '<a href="#"';
        echo "&s_Code=$s_Code&s_Name=$s_Name&s_Continent=$s_Continent&s_LocalName=$s_LocalName&s_Code2=$s_Code2&search=";
        echo '>< Prev &nbsp;&nbsp;&nbsp  </a>';
    } else {

        echo '<li class="a"} ">';
        echo '<a href="?pageno=' . ($pageno - 1);
        echo "&s_Code=$s_Code&s_Name=$s_Name&s_Continent=$s_Continent&s_LocalName=$s_LocalName&s_Code2=$s_Code2&search=";
        echo '">< Prev&nbsp;&nbsp;&nbsp  </a>';
    }
    echo '</li>';

    echo '<li>';
    if ($pageno >= $total_pages) {

        echo '<li class="disabled"} ">';
        echo '<a href="#"';
        echo "&s_Code=$s_Code&s_Name=$s_Name&s_Continent=$s_Continent&s_LocalName=$s_LocalName&s_Code2=$s_Code2&search=";
        echo '> &nbsp;&nbsp;&nbsp Next ></a>';
    } else {

        echo '<li class="a"} ">';
        echo '<a href="?pageno=' . ($pageno + 1);
        echo "&s_Code=$s_Code&s_Name=$s_Name&s_Continent=$s_Continent&s_LocalName=$s_LocalName&s_Code2=$s_Code2&search=";
        echo '">  &nbsp; &nbsp;&nbsp Next ></a>';
    }
    echo '</li>';
    echo '<li><a href="?pageno=' . $total_pages;
    echo "&s_Code=$s_Code&s_Name=$s_Name&s_Continent=$s_Continent&s_LocalName=$s_LocalName&s_Code2=$s_Code2&search=";
    echo '">  &nbsp;&nbsp; Last >></a></li>';
    echo '</ul>';
}



/******** Function to check if all the fields are empty ********/

function emptyField()
{
    $fields = array("s_Code", "s_Name", "s_Continent", "s_LocalName", "s_Code2");
    foreach ($fields as $field) {
        if (!empty($_GET[$field])) {
            return false;
        }
    }
    return true;
}

/******** Function to print headers of table ********/

function printHeader()
{
    echo "<table class='table table-striped'>";
    echo "<tr>";
    echo "<th>Code</th>";
    echo "<th>Name</th>";
    echo "<th>Continent</th>";
    echo "<th>Region</th>";
    echo "<th>Surface Area</th>";
    echo "<th>Independence Year</th>";
    echo "<th>Population</th>";
    echo "<th>Life Expectancy</th>";
    echo "<th>GNP</th>";
    echo "<th>GNP Old</th>";
    echo "<th>Local Name</th>";
    echo "<th>Government Form</th>";
    echo "<th>Head of State</th>";
    echo "<th>Capital</th>";
    echo "<th>Code 2</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "</tr>";
}
