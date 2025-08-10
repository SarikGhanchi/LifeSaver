<?php
session_start();
include '../partials/dbconnect.php';

if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: ../login.php");
    exit;
}

$sql = "SELECT * FROM notices ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Notices - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">
    <h2 class="text-danger">Manage Notices</h2>
    <a href="add_notice.php" class="btn btn-primary mb-3">Add Notice</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Notice</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['notice']); ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a href="edit_notice.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_notice.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php'; ?>