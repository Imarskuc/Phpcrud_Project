<?php
// read.php - READ a single record by ID (?viewid=)
include('dbconnection.php');

$vid  = intval($_GET['viewid'] ?? 0);
$stmt = mysqli_prepare($con, 'SELECT * FROM tblusers WHERE ID = ?');
mysqli_stmt_bind_param($stmt, 'i', $vid);
mysqli_stmt_execute($stmt);
$ret = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Crud Operation Using PHP and MySQLi</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-xl">
  <div class="table-responsive">
    <div class="table-wrapper">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-5"><h2>User <b>Details</b></h2></div>
          <div class="col-sm-3"><a href="index.php" class="btn btn-secondary">Back</a></div>
        </div>
      </div>

      <table class="table table-bordered">
        <tbody>
<?php while ($row = mysqli_fetch_array($ret)) { ?>
          <tr>
            <th>First Name</th><td><?php echo htmlspecialchars($row['FirstName']); ?></td>
            <th>Last Name</th><td><?php echo htmlspecialchars($row['LastName']); ?></td>
          </tr>
          <tr>
            <th>Email</th><td><?php echo htmlspecialchars($row['Email']); ?></td>
            <th>Mobile Number</th><td><?php echo htmlspecialchars($row['MobileNumber']); ?></td>
          </tr>
          <tr>
            <th>Address</th><td><?php echo htmlspecialchars($row['Address']); ?></td>
            <th>Creation Date</th><td><?php echo htmlspecialchars($row['CreationDate']); ?></td>
          </tr>
<?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
