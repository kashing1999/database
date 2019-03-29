<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <br>
            <h1 class="display-4">Deleted</h1>
            <hr>

        <?php
            include 'config.php';
            $sql = "DELETE FROM city WHERE ID=".$_POST["ID"];
            $conn->query($sql);

            echo "<form action='query.php' method='POST'>";
            echo "<button class='submit-button btn btn-outline-secondary'>Go back</button>";
            echo "</form>";
            $conn->close();
        ?>
    </body>
</html>