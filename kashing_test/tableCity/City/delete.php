<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <br>
                <?php
                    include 'config.php';
                    
                    deleteEntry($conn);

                    $conn->close();

                    function deleteEntry($conn) {
                        $sql = "DELETE FROM city WHERE ID=".$_POST["ID"];
                        $conn->query($sql);

                        echo '<h1 class="display-4">Deleted</h1>';
                        echo '<hr>';

                        echo "<form action='query.php' method='POST'>";
                        echo "<button class='submit-button btn btn-outline-secondary'>Go back</button>";
                        echo "</form>";
                    }
                ?>
            </div>
    </body>
</html>