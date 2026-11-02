<?php
// edit.php - UPDATE a record (?editid=): pre-filled form + handler
include('dbconnection.php');

$eid = intval($_GET['editid'] ?? 0);

if (isset($_POST['submit'])) {
    $fname   = trim($_POST['fname']);
    $lname   = trim($_POST['lname']);
    $contno  = trim($_POST['contactno']);
    $email   = trim($_POST['email']);
    $address = trim($_POST['address']);

    $stmt = mysqli_prepare(
        $con,
        'UPDATE tblusers SET FirstName=?, LastName=?, MobileNumber=?, Email=?, Address=? WHERE ID=?'
    );
    mysqli_stmt_bind_param($stmt, 'ssissi', $fname, $lname, $contno, $email, $address, $eid);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('You have successfully updated the data');</script>";
        echo "<script>document.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}

// Load current values to pre-fill the form
$stmt = mysqli_prepare($con, 'SELECT * FROM tblusers WHERE ID = ?');
mysqli_stmt_bind_param($stmt, 'i', $eid);
mysqli_stmt_execute($stmt);
$ret = mysqli_stmt_get_result($stmt);
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
<?php while ($row = mysqli_fetch_array($ret)) { ?>
    <h2>Update</h2>
    <p class="hint-text">Update your info.</p>

    <div class="form-group">
      <div class="row">
        <div class="col"><input type="text" class="form-control" name="fname" value="<?php echo htmlspecialchars($row['FirstName']); ?>" required></div>
        <div class="col"><input type="text" class="form-control" name="lname" value="<?php echo htmlspecialchars($row['LastName']); ?>" required></div>
      </div>
    </div>

    <div class="form-group">
      <input type="text" class="form-control" name="contactno" value="<?php echo htmlspecialchars($row['MobileNumber']); ?>" required maxlength="10" pattern="[0-9]+">
    </div>

    <div class="form-group">
      <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
    </div>

    <div class="form-group">
      <textarea class="form-control" name="address" required><?php echo htmlspecialchars($row['Address']); ?></textarea>
    </div>
<?php } ?>
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
    </div>
  </form>
  <div class="text-center"><a href="index.php">Back to list</a></div>
</div>
</body>
</html>
