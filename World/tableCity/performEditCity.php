<!DOCTYPE html>
<html>
    <head>
        Edit City
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <?php
                include 'config.php';
                include '../mynavbar.php';
                $countrycode = addslashes($_POST["countrycode"]);
                if (checkCountryCode($countrycode, $conn)) {
                    $sql  = "UPDATE city SET ";
                    $sql .= "name="."'".addslashes($_POST["name"])."', ";
                    $sql .= "countrycode="."'".addslashes($_POST["countrycode"])."', ";
                    $sql .= "district="."'".addslashes($_POST["district"])."', ";
                    $sql .= "population="."'".addslashes($_POST["population"])."' ";
                    $sql .= "WHERE ID=".addslashes($_POST["ID"]).";";
                    $conn->query($sql);
                    echo '<h1 class="display-4">Successful</h1>';
                    echo "<hr>";
                    echo "Your edit was successful ! ";
                    echo '<br>';
                    echo "<form action='queryCity.php' method='POST'>";
                    echo "<br><button name='ID' class='submit-button  btn btn-outline-secondary' value=".$_POST["ID"].">back</button>";
                    echo "</form>";
                }
                else {

                    echo '<h1 class="display-4">Unsuccessful</h1>';
                    echo "<hr>";
                    echo "Country code not found";
                    echo '<br>';
                    echo "<form action='queryCity.php' method='POST'>";
                    echo "<br><button name='ID' class='submit-button  btn btn-outline-secondary' value=".$_POST["ID"].">back</button>";
                    echo "</form>";
                }
                
                $conn->close();

                function checkCountryCode($countrycode, $conn)
                {
                    $query = "SELECT DISTINCT CountryCode from city";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        if ($row["CountryCode"] == $countrycode) {
                            return true;
                        }
                    }
                    return false;
                }

            ?>
        </div>
    </body>
</html>