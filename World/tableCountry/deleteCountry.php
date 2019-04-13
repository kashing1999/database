<!DOCTYPE HTML>
<html>

<head>
    <!---Bootstrap--->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!--End BootStrap-->
    <!-- To control how website shows up on mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Country</title>
</head>

<body>
    <div class="container">
        <!-- Display 'Country Deleted' -->
        <h1 class="display-4">Country Deleted</h1>
        <hr>

        <?php
        // Set session cache limiter to false to avoid session expired
        ini_set('session.cache_limiter', 'public');
        session_cache_limiter(false);

        // Start session
        session_start();

        include 'includes_country/Config.php';

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            if (isset($_POST["Code"])) {
                // Set the country code as session variable 
                $_SESSION['wannaSearchCode'] = $_POST["Code"];
            }
            // SQL query
            $sql = "DELETE FROM country WHERE Code = '" . $_SESSION['wannaSearchCode'] . "'";
            $conn->query($sql);
        }

        // (JavaScript) Display alert box
        echo '<script language="javascript">';
        echo 'alert("Country deleted successfully .");';
        echo 'window.location= "selectCountry.php"';
        echo '</script>';

        // Back button
        echo '<form method ="POST" action ="' . htmlspecialchars('selectCountry.php') . ' ">';
        echo "<button class='submit-button btn btn-outline-secondary'>Back</button>";
        echo "</form>";

        // Unset session variable and destroy current session
        session_unset();
        session_destroy();
        // header('Location: select.php');
        ?>
    </div>
</body>

</html>