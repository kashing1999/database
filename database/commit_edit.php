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
            $sql  = "UPDATE city SET ";
            $sql .= "name="."'".$_POST["name"]."', ";
            $sql .= "countrycode="."'".$_POST["countrycode"]."', ";
            $sql .= "district="."'".$_POST["district"]."', ";
            $sql .= "population="."'".$_POST["population"]."' ";
            $sql .= "WHERE ID=".$_POST["ID"].";";
            $conn->query($sql);
            echo "Your edit was successful ! ";
            echo '<br>';
            echo "<form action='edit.php' method='POST'>";
            echo "<br><button name='ID' class='submit-button  btn btn-outline-secondary' value=".$_POST["ID"].">edit</button>";
            echo "</form>";
            $conn->close();
        ?>
        </div>
    </body>
</html>