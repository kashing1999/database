<!DOCTYPE html> 
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <br>
        <form action="query.php" method="POST">
            Name: <input type="text" name = "name">
            CountryCode: <input type="text" name="countrycode">
            District: <input type="text" name="district">
            Population: <input type="text" name="population">
            <button class="submit-button" >Query</button>
        </form>
        <br>
        <form action="insert.html">
            <button class="float-left submit-button" >Insert</button>
        </form>
        <br>
    </body>
</html>