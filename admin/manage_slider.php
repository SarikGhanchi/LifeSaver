<?php
session_start();
include '../partials/dbconnect.php';

// Fetch existing sliders from the database
$sql = "SELECT * FROM slider ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Slider - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">
    <h2 class="text-danger">Manage Slider</h2>
    <a href="add_slider.php" class="btn btn-primary mb-3">Add New Slider</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><img src="../uploads/<?= $row['image']; ?>" alt="Slider Image" width="100"></td>
                    <td>
                        <a href="edit_slider.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_slider.php?id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>