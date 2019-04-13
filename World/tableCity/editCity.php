<!DOCTYPE html>
<html>

<head>
    Edit City
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <?php include '../mynavbar.php'; ?>
    <div class="container">
        <br>
        <h1 class="display-4">Edit City</h1>
        <hr>
        <br>
        <?php
        include 'config.php';

        createEditForm($conn);

        $conn->close();

        function createEditForm($conn)
        {
            $ID = $_POST["ID"];
            $sql = 'SELECT * FROM city where ID=' . $ID;
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            echo "<form action='performEditCity.php' method='POST'>";
            $name = $row["Name"];
            $countrycode = $row["CountryCode"];
            $district = $row["District"];
            $population = $row["Population"];
            echo '<div class="form-group">';
            echo '<label for="usr">Name:</label>';
            echo '<input type="text" class="form-control" id="usr" value="' . $name . '" name="name">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label for="usr">Country Code:</label>';
            echo '<input type="text" class="form-control" id="usr" value="' . $countrycode . '" name="countrycode">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label for="usr">District:</label>';
            echo '<input type="text" class="form-control" id="usr" value="' . $district . '" name="district">';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label for="usr">Population:</label>';
            echo '<input type="text" class="form-control" id="usr" value="' . $population . '" name="population">';
            echo '</div>';
            echo '<br>';
            echo "<button name='ID' class='submit-button btn btn-outline-secondary' value=" . $ID . ">Edit</button>";

            echo "</form>";
        }
        ?>
    </div>
</body>

</html>