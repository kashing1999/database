<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        include 'config.php';

        insertData($conn);
        $conn->close();

        //*               Funtions                *//


        function insertData($conn)
        {
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $countrycode = $_POST["countrycode"];
                if (checkCountryCode($countrycode, $conn)) {
                    $sql = "INSERT INTO city (Name, CountryCode, District, Population) VALUES (" . "'" . $_POST["name"] . "'," . "'" . $_POST["countrycode"] . "'," . "'" . $_POST["district"] . "'," . "'" . $_POST["population"] . "');";
                    $conn->query($sql);
                    echo '<h1 class="display-4">Successful</h1>';
                } else {
                    echo "Country code not found";
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
        <form action="insertCity.html">
            <button class="submit-button btn btn-outline-secondary">Insert another</button>
        </form>


    </div>
</body>

</html>