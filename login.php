<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $Password = $_POST["password"];
            require_once ("database.php");
            $sql = "SELECT * FROM registration WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($admin) {
                if (password_verify($Password, $admin["password"])) {
                    header("Location: index.php");
                    session_start();
                    $_SESSION["admin"] = "yes";
                    header("Location: index.php");
            
                    die();
                    
                }else {
                    echo "<div class = 'alert alert-danger'>Passwords do not match</div>";
                }
            }else {
                echo "<div class = 'alert alert-danger'>Emails do not match</div>";
            } 
            $arr = array();
            if(empty($email) OR empty($password)){
                array_push($arr, "All fields are required!");
            }
            if(count($arr)>0) {
                foreach ($arr as $err) {
                    echo "<div class = 'alert alert-danger'>$err</div>";
                }
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
        </form>
    </div>
</body>
</html>