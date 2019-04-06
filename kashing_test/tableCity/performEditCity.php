<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <br>
            <h1 class="display-4">Successful</h1>
            <hr> 
        <?php
            include 'config.php';
            $sql  = "UPDATE city SET ";
            $sql .= "name="."'".$_POST["name"]."', ";
            $sql .= "countrycode="."'".$_POST["countrycode"]."', ";
            $sql .= "district="."'".$_POST["district"]."', ";
            $sql .= "population="."'".$_POST["population"]."' ";
            $sql .= "WHERE ID=".$_POST["ID"].";";
            $conn->query($sql);
            echo "Your edit was successful ! ";
            echo '<br>';
            echo "<form action='queryCity.php' method='POST'>";
            echo "<br><button name='ID' class='submit-button  btn btn-outline-secondary' value=".$_POST["ID"].">back</button>";
            echo "</form>";
            $conn->close();
        ?>
        </div>
    </body>
</html>