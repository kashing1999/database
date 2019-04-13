<!DOCTYPE html>
<html>
    <head>
    Search City
    <style>
        .pagination {
            justify-content: center;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">       
    <link rel="stylesheet" href="queryCity.css">
        <meta charset= "utf-8">
        <meta name="viewport">
    </head>
    <body>
    <?php include '../mynavbar.php'; ?>
    <br>
        <div class="container">
        <h1 class="display-4">City</h1>
            <hr>
            <form action="queryCity.php" method="GET">
                <div class = "row">
                    <div class="col-sm-3">Name: &nbsp;&nbsp;<input id= "searchdetailbox" type="text" name = "name"></div>
                    <div class="col-sm-2">CountryCode: &nbsp;<input id= "searchdetailbox" type="text" name="countrycode"></div>
                    <div class="col-sm-3">District: &nbsp;<input id= "searchdetailbox" type="text" name="district"></div>
                    <div class="col-sm-2">Population: <input id= "searchdetailbox" type="text" name="population">&nbsp;</div>
            
                    <div class="col-sm-2" id="searchbox">
                        <button class=" submit-button btn btn-outline-secondary">Search</button>
                    </div>
                </div>
            </form>
            <br>
            <?php
                include 'config.php';           

                echo "<table class='table table-striped'>";

                // header row
                echo "<tr>";
                    printTableHeadingData("Name");
                    printTableHeadingData("Country Code");
                    printTableHeadingData("District");
                    printTableHeadingData("Population");
                    printTableHeadingData("");
                    printTableHeadingData("");
                echo "</tr>";

                $result = $conn->query(sqlCount($fields));
                $row = ($result->fetch_assoc());
                $total = $row["count"];
                $limit = 20;
                $total_pages = ceil($total / $limit);
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                }
                else 
                    $pageno = 1;
                $offset = ($pageno-1) * $limit;
                
                if (searchbarEmpty())
                    $sql = "SELECT * FROM city ORDER by Name LIMIT $offset, $limit;";

                else {
                    $sql = "SELECT * FROM city WHERE ";
                    foreach($fields as $field) {
                        if (!empty($_GET[$field])) {
                            $item = addslashes($_GET[$field]);
                            $sql .= $field."='".$item."' AND "; 
                        }
                    }
                    $sql .="true ORDER by Name LIMIT $offset, $limit;";
                }
                $result = $conn->query($sql);

                printTableRows($result);
                
                echo "</table>";
                
                $conn->close();

                function printTableRows($result) {
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                $ID = $row["ID"];
                                printTableRowData($row["Name"]);
                                printTableRowData($row["CountryCode"]);
                                printTableRowData($row["District"]);
                                printTableRowData($row["Population"]);
    
                                $editbutton = "<form action='editCity.php' method='POST'>";
                                $editbutton .= "<button name='ID' class='submit-button  btn btn-outline-secondary' value=$ID>edit</button>";
                                $editbutton .= "</form>";
                                
                                $deletebutton = "<form action='deleteCity.php' method='POST'>";
                                $deletebutton .= "<button name='ID' class='submit-button  btn btn-outline-secondary' value=$ID>delete</button>";
                                $deletebutton .= "</form>";
                                
                                printTableRowData($editbutton);
                                printTableRowData($deletebutton);
                            echo "</tr>";
                        }
                    }
                }

                function sqlCount($fields) {
                    if (searchbarEmpty())
                        $sql = "SELECT COUNT(*) as count FROM city ORDER by Name;";

                    else {
                        $sql = "SELECT COUNT(*) as count FROM city WHERE ";
                        foreach($fields as $field) {
                            if (!empty($_GET[$field])) {
                                $item = addslashes($_GET[$field]);
                                $sql .= $field."='".$item."' AND "; 
                            }
                        }
                        $sql .="true;";
                    }
                    return $sql;
                }
                

                function printTableHeadingData($rowdata) {
                    echo "<th>";
                        echo $rowdata;
                    echo "</th>";
                }

                function printTableRowData($rowdata) {
                    echo "<td>";
                        echo $rowdata;
                    echo "</td>";
                }

                function searchbarEmpty() {
                    $fields = array("name", "countrycode", "district", "population");
                    foreach ($fields as $field) {
                        if (!empty($_GET[$field]))
                            return false;
                    }
                    return true;
                }
                
                function echoGetRequest() {
                    $name = $_GET["name"];
                    $countrycode = $_GET["countrycode"];
                    $district = $_GET["district"];
                    $population = $_GET["population"];
                    echo "&name=$name&countrycode=$countrycode&district=$district&population=$population";
                }

        echo '<ul class="pagination">';
        echo "<li>";
            echo '<a href="?pageno=1';
            echoGetRequest();
            echo '">First</a>';
        echo "</li> &nbsp";
        echo '<li>';
            echo '<a href="';
            if ($pageno <= 1) {
                echo '?pageno='.$pageno;
        } else {
            echo "?pageno=".($pageno - 1);
        } 
            echoGetRequest();
            echo '">Prev</a>';
        echo "</li> &nbsp";
        echo '<li>';
            echo '<a href="';
            if ($pageno >= $total_pages)
                echo "?pageno=".($pageno);
            else
                echo "?pageno=".($pageno+1); 
            echoGetRequest();
            echo '">Next</a>';
        echo '</li> &nbsp';
        echo '<li>';
            echo '<a href="?pageno=';
            echo $total_pages;
            echoGetRequest();
            echo '">Last</a>';
        echo '</li>';
        echo '</ul>';
        echo "</div>";
        ?>
        </div>
    </body>
</html>
