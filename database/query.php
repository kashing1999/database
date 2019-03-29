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
                // table of results
                echo "<table class='table table-striped'>";

                // first row
                echo "<tr>";
                    printTableHeading("Name");
                    printTableHeading("Country Code");
                    printTableHeading("District");
                    printTableHeading("Population");
                    printTableHeading("");
                    printTableHeading("");
                echo "</tr>";

                if (checkEmpty())
                    $sql = "SELECT * FROM city;";
                
                else {
                    $sql = "SELECT * FROM city WHERE ";
                    foreach($fields as $field) {
                        if (!empty($_POST[$field]))
                            $sql .= $field."='".$_POST[$field]."' "; 
                    }
                    $sql .=";";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                            $ID = $row["ID"];
                            printTableRow($row["Name"]);
                            printTableRow($row["CountryCode"]);
                            printTableRow($row["District"]);
                            printTableRow($row["Population"]);

                            $editbutton = "<form action='edit.php' method='POST'>";
                            $editbutton .= "<button name='ID' class='submit-button  btn btn-outline-secondary' value=$ID>edit</button>";
                            $editbutton .= "</form>";
                            
                            $deletebutton = "<form action='delete.php' method='POST'>";
                            $deletebutton .= "<button name='ID' class='submit-button  btn btn-outline-secondary' value=$ID>delete</button>";
                            $deletebutton .= "</form>";
                            
                            printTableRow($editbutton);
                            printTableRow($deletebutton);
                        echo "</tr>";
                    }
                }
                echo "</table>";
                $conn->close();

                function printTableHeading($rowdata) {
                    echo "<th>";
                        echo $rowdata;
                    echo "</th>";
                }

                function printTableRow($rowdata) {
                    echo "<td>";
                        echo $rowdata;
                    echo "</td>";
                }

                function checkEmpty() {
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