<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <br>
        <?php
            include 'config.php';

            createEditForm($conn);

            $conn->close();

            function createEditForm($conn) {
                $ID = $_POST["ID"];
                $sql = 'SELECT * FROM city where ID='.$ID;
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<form action='performEdit.php' method='POST'>";
                echo "Name: ";
                echo "<input type='text' value='".$row["Name"]."' name='name'><br>";
                echo "CountryCode: ";
                echo "<input type='text' value='".$row["CountryCode"]."' name='countrycode'><br>";
                echo "District: ";
                echo "<input type='text' value='".$row["District"]."' name='district'><br>";
                echo "Population: ";
                echo "<input type='text' value='".$row["Population"]."' name='population'><br>";
                echo "<button class='submit-button' name='ID' value=".$ID.">Edit</button>";
                echo "</form>";
            }
        ?>
    </body>
</htm>