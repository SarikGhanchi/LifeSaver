<?php
session_start();
include '../partials/dbconnect.php';

if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch events
$sql = "SELECT * FROM events ORDER BY event_id DESC"; // or whatever your actual column is
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Events - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">
    <h2 class="text-danger">Manage Events</h2>
    <a href="add_event.php" class="btn btn-primary mb-3">Add New Event</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Event Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td><?= htmlspecialchars($row['event_date']); ?></td>
                    <td>
                        <?php if (!empty($row['image'])): ?>
                            <img src="../uploads/<?= $row['image']; ?>" alt="Event Image" width="100">
                        <?php else: ?>
                            <span>No image</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_event.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_event.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
