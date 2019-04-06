<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="query.css">
        <meta charset= "utf-8">
        <meta name="viewport">
    </head>
    <body>
        <div class="container">
        <h1 class="display-4">City</h1>
            <hr>
            <form action="query.php" method="POST">
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

                printTable($conn, $fields);
                
                $conn->close();

                                                           
                //*               Funtions               *//


                function printTable($conn, $fields) {
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
                    
                    $sql = sqlQuery($fields);
                    $result = $conn->query($sql);

                    printTableRows($result);
                    
                    echo "</table>";
                }

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
    
                                $editbutton = "<form action='edit.php' method='POST'>";
                                $editbutton .= "<button name='ID' class='submit-button  btn btn-outline-secondary' value=$ID>edit</button>";
                                $editbutton .= "</form>";
                                
                                $deletebutton = "<form action='delete.php' method='POST'>";
                                $deletebutton .= "<button name='ID' class='submit-button  btn btn-outline-secondary' value=$ID>delete</button>";
                                $deletebutton .= "</form>";
                                
                                printTableRowData($editbutton);
                                printTableRowData($deletebutton);
                            echo "</tr>";
                        }
                    }
                }

                function sqlQuery($fields) {
                    // if search bar empty, query all
                    if (searchbarEmpty())
                        $sql = "SELECT * FROM city ORDER by Name;";

                    else {
                        $sql = "SELECT * FROM city WHERE ";
                        foreach($fields as $field) {
                            if (!empty($_POST[$field]))
                                $sql .= $field."='".$_POST[$field]."' AND "; 
                        }
                        $sql .="true ORDER by Name;";
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
                        if (!empty($_POST[$field]))
                            return false;
                    }
                    return true;
                }
            ?>
        </div>
    </body>
</html>