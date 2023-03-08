<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
  <div class="container">
    <h1 class="dash">Welcome to Dashboard</h1>
    <div class="row">
      <div class="col-md-8">
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
      <div class="col-md-4">
        <a href="enrollment.php" class="btn btn-success">Enroll New Student</a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <a href="students.php" class="btn btn-primary btn-block">View All Students</a>
      </div>
      <div class="col-md-4">
        <a href="add-student.php" class="btn btn-primary btn-block">Add Student</a>
      </div>
      <div class="col-md-4">
        <a href="edit-student.php" class="btn btn-primary btn-block">Edit Student</a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-4">
        <a href="delete-student.php" class="btn btn-danger btn-block">Delete Student</a>
      </div>
      <div class="col-md-4">
        <a href="attendance.php" class="btn btn-info btn-block">Take Attendance</a>
      </div>
      <div class="col-md-4">
        <a href="attendance-report.php" class="btn btn-info btn-block">Attendance Report</a>
      </div>
    </div>
    <hr>
    <a href="logout.php" class="btn btn-warning">Log out</a>
  </div>
</body>
</html>
  
  
