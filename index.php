<?php
// index.php - READ (all records) + DELETE handler
include('dbconnection.php');

// Code for deletion
if (isset($_GET['delid'])) {
    $rid  = intval($_GET['delid']);
    $stmt = mysqli_prepare($con, 'DELETE FROM tblusers WHERE ID = ?');
    mysqli_stmt_bind_param($stmt, 'i', $rid);
    mysqli_stmt_execute($stmt);
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PHP CRUD - All Users</title>
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
          <div class="col-sm-8"><h2>User <b>Details</b></h2></div>
          <div class="col-sm-4"><a href="insert.php" class="btn btn-info">Add New User</a></div>
        </div>
      </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Registered</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
<?php
$ret = mysqli_query($con, 'SELECT * FROM tblusers ORDER BY ID DESC');
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
          <tr>
            <td><?php echo $cnt; ?></td>
            <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
            <td><?php echo htmlspecialchars($row['LastName']); ?></td>
            <td><?php echo htmlspecialchars($row['Email']); ?></td>
            <td><?php echo htmlspecialchars($row['MobileNumber']); ?></td>
            <td><?php echo htmlspecialchars($row['CreationDate']); ?></td>
            <td>
              <a href="read.php?viewid=<?php echo (int)$row['ID']; ?>" class="btn btn-sm btn-primary">View</a>
              <a href="edit.php?editid=<?php echo (int)$row['ID']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="index.php?delid=<?php echo (int)$row['ID']; ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Do you really want to delete this record?');">Delete</a>
            </td>
          </tr>
<?php
    $cnt++;
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
