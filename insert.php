<?php
// insert.php - CREATE: form + handler for adding a new user
include('dbconnection.php');

if (isset($_POST['submit'])) {
    $fname   = trim($_POST['fname']);
    $lname   = trim($_POST['lname']);
    $contno  = trim($_POST['contactno']);
    $email   = trim($_POST['email']);
    $address = trim($_POST['address']);

    $stmt = mysqli_prepare(
        $con,
        'INSERT INTO tblusers (FirstName, LastName, MobileNumber, Email, Address) VALUES (?, ?, ?, ?, ?)'
    );
    mysqli_stmt_bind_param($stmt, 'ssiss', $fname, $lname, $contno, $email, $address);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('You have successfully inserted the data');</script>";
        echo "<script>document.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>PHP Crud Operation!!</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="signup-form">
    <form method="POST">
      <h2>Fill Data</h2>
      <p class="hint-text">Fill below form.</p>

      <div class="form-group">
        <div class="row">
          <div class="col"><input type="text" class="form-control" name="fname" placeholder="First Name" required></div>
          <div class="col"><input type="text" class="form-control" name="lname" placeholder="Last Name" required></div>
        </div>
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="contactno" placeholder="Enter your Mobile Number" required maxlength="10" pattern="[0-9]+">
      </div>

      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Enter your Email id" required>
      </div>

      <div class="form-group">
        <textarea class="form-control" name="address" placeholder="Enter Your Address" required></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
      </div>
    </form>
    <div class="text-center">View Already Inserted Data!! <a href="index.php">View</a></div>
  </div>
</body>
</html>
