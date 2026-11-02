<?php
/**
 * dbconnection.php
 * Opens one shared MySQL connection ($con) used by every other page.
 * Default XAMPP credentials: user "root", empty password.
 */
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $con = mysqli_connect('localhost', 'root', '', 'phpcrud');
    mysqli_set_charset($con, 'utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Connection Fail: ' . htmlspecialchars($e->getMessage()));
}
