<!DOCTYPE html>
<html>
    <head>
        Delete City
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">   
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

                        echo "<form action='queryCity.php' method='POST'>";
                        echo "<button class='submit-button btn btn-outline-secondary'>Go back</button>";
                        echo "</form>";
                    }
                ?>
            </div>
    </body>
</html>