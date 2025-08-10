<?php
include '../partials/dbconnect.php';

$sql = "SELECT * FROM slider ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<style>
.slider-thumb {
    width: 120px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #ddd;
}
</style>

<div class="col-md-10 p-4">
    <h2 class="text-danger">Manage Banner Slider</h2>
    <div class="mt-4">
        <a href="add_slider.php" class="btn btn-primary">Add New Slider</a>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><img src="../uploads/<?= $row['image']; ?>" alt="Slider Image" class="slider-thumb"></td>
                    <td>
                        <a href="edit_slider.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_slider.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this slider?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>