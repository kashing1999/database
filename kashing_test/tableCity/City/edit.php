<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <br>
            <h1 class="display-4">Edit City</h1>
                <hr>
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

                    echo "<form action='commit_edit.php' method='POST'>";
                    $name = $row["Name"];
                    $countrycode = $row["CountryCode"];
                    $district = $row["District"];
                    $population = $row["Population"];
                    echo '<div class="form-group">';
                        echo '<label for="usr">Name:</label>';
                        echo '<input type="text" class="form-control" id="usr" value='.$name.' name="name">';
                    echo '</div>';

                    echo '<div class="form-group">';
                        echo '<label for="usr">Country Code:</label>';
                        echo '<input type="text" class="form-control" id="usr" value='.$countrycode.' name="countrycode">';
                    echo '</div>';

                    echo '<div class="form-group">';
                        echo '<label for="usr">District:</label>';
                        echo '<input type="text" class="form-control" id="usr" value='.$district.' name="district">';
                    echo '</div>';

                    echo '<div class="form-group">';
                        echo '<label for="usr">Population:</label>';
                        echo '<input type="text" class="form-control" id="usr" value='.$population.' name="population">';
                    echo '</div>';
                    echo '<br>';
                    echo "<button name='ID' class='submit-button btn btn-outline-secondary' value=".$ID.">Edit</button>";
                    
                    echo "</form>";
                }
            ?>
        </div>
    </body>
</htm>