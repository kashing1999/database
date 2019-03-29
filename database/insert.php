<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
            <br>
            <h1 class="display-4">Successful</h1>
            <hr>
    
        <?php
            include 'config.php';
            $countrycode = $_POST["countrycode"];
            if (checkCountryCode($countrycode, $conn)) {
                $sql = "INSERT INTO city (Name, CountryCode, District, Population) VALUES ("."'".$_POST["name"]."',"."'".$_POST["countrycode"]."',"."'".$_POST["district"]."',"."'".$_POST["population"]."');";
                $conn->query($sql);
                echo "Successfully added";
                $conn->close();
            }
            else {
                echo "Country code not found";
            }

            function checkCountryCode($countrycode, $conn) {
                $query = "SELECT DISTINCT CountryCode from city";
                $result = $conn->query($query);
                while($row = $result->fetch_assoc()) {
                    if ($row["CountryCode"] == $countrycode) {
                        return true;
                    }
                }
                return false;
            }
        ?>
        <form action="insert.html">
        <br>
        <button class=" submit-button btn btn-outline-secondary" >Insert another</button>

        </div>
        </form>
    </body>
</html>