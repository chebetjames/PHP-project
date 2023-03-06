<?php
session_start();
if (isset($_SESSION["admin"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body>___
    
    <div class="container">
        <?php
        
        //check if the form has been submitted and is error free
        if(isset($_POST["submit"])){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeatPassword = $_POST["repeat_password"];
            $date = $_POST["date"];

        //encrypt the users password using the password hash method 
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        //create an empty array and store it in a varaible($errors) to capture various errors
            $errors = array();
            if ($username !== ucfirst($username)) {
                array_push($errors, "First character should be uppercase");
            }
            if (empty($username) OR empty($email) OR empty($password) OR empty($repeatPassword)){
                array_push($errors, "All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if(strlen($password)<8){
                array_push($errors, "Password is short");
            }
            if($repeatPassword !== $password) {
                array_push($errors, "Passwords do not match");
            }

            // include our database.php file inside our registration.php file
            require_once ("database.php");

            //check all emails in the database and return an error if an email already exists in the database
            $sql = "SELECT * FROM registration WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors, "Email already exists!!!");
            }
            if (count($errors)>0) {
                foreach ($errors as $error) {
                    echo "<div class = 'alert alert-danger'>$error</div>";
                
            }
            
            }else {

                //write a query to insert data into the database
                $sql = "INSERT INTO registration (username, email, password, date) VALUES (?, ?, ?, ?)";

                //initialize a statement object for preparing an sql statement and return a handle for it
                $stmt = mysqli_stmt_init($conn);

                /*prepare the sql statement for execution. This returns a boolean value to check whether
                the data has actually been inserted into the database or not*/
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    //bind the specified variables to the placeholders
                    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $passwordHash, $date);
                    mysqli_stmt_execute($stmt);
                    echo "<div class = 'alert alert-success'>You are successfully registered</div>";
                    header("Location: login.php");
                }else {
                    echo "Something went wrong";
                }
            }
    }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type = "text" class="form-control" name = "username" placeholder="Username:">
            </div>
            <div class="form-group">
                <input type = "email" class="form-control" name = "email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type = "password" class="form-control"name = "password" placeholder="Password:">
            </div> 
            <div class="form-group">
                <input type = "text" class="form-control" name = "repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-group">
                <label for="date" class = "form-label">Date of registration:</label>
                <input type="date" id = "date" name="date" class="form-control"> 
            </div>
            <div class="form-btn">
                <input type = "submit" class="btn btn-primary" name = "submit" value="Register">
            </div>
            
        </form>
    </div>
</body>
</html>