<!DOCTYPE html>
<html>

<head>
    Insert City
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        include 'config.php';
        include '../mynavbar.php';

        insertData($conn);
        $conn->close();

        //*               Funtions                *//


        function insertData($conn)
        {
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $countrycode = $_POST["countrycode"];
                if (checkCountryCode($countrycode, $conn)) {
                    $sql = "INSERT INTO city (Name, CountryCode, District, Population) VALUES (" . "'" . addslashes($_POST["name"]) . "'," . "'" . addslashes($_POST["countrycode"]) . "'," . "'" . addslashes($_POST["district"]) . "'," . "'" . addslashes($_POST["population"]) . "');";
                    $conn->query($sql);
                    echo '<h1 class="display-4">Successful</h1>';
                } else {
                    echo "<h1 class='display-4'>Country code not found</h1>";
                }
            }
        }

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
        <br>
        <form action="insertCity.php">
            <button class="submit-button btn btn-outline-secondary">Insert another</button>
        </form>


    </div>
</body>

</html>
