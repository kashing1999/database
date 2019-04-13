<!DOCTYPE html>
<html>
    <head>
        Insert City
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">    </head>
    <body>
        <?php include '../mynavbar.php'; ?>
        <div class="container">
            <br>
            <h1 class="display-4">Insert into City</h1>
            <hr>

                <form action="performInsertCity.php" method="POST">

                    <div class="form-group">
                        <label for="usr">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="usr">Country Code:</label>
                        <input type="text" class="form-control" name="countrycode" required>
                    </div>
                              
                    <div class="form-group">
                        <label for="usr">District:</label>
                        <input type="text" class="form-control" name="district" required><br>
                    
                    <div class="form-group">
                        <label for="usr">Population:</label>
                        <input type="text" class="form-control" name="population" required>
                    </div>
                    <form>
                    <button class=" submit-button btn btn-outline-secondary" >Submit</button>
                    </form>
                    <br>
                    <form action="queryCity.php">
                        <br>
                        <button class="submit-button btn btn-outline-secondary" >Back</button>
                    </form>
        
                </form>
        </div>
    </body>
</html>
