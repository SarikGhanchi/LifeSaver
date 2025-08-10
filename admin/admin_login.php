<?php
session_start();
include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // Prepare SQL
        $sql = "SELECT * FROM admin WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                // ✅ Verify password
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin_loggedin'] = true;
                    $_SESSION['admin_name'] = $username;
                    header("Location: dashboard.php");
                    exit;
                } else {
                    echo "<script>alert('❌ Invalid password.'); window.location.href='../login.php';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('❌ No admin found with that username.'); window.location.href='../login.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('❌ Failed to prepare SQL.'); window.location.href='../login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Please enter both username and password.'); window.location.href='../login.php';</script>";
        exit;
    }
}
?>
