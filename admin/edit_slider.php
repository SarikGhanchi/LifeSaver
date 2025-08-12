<?php
//session_start();
include '../partials/dbconnect.php';

if (!isset($_SESSION['admin_loggedin'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['slider_id'], $_POST['slider_title'], $_POST['slider_image'])) {
        $slider_id = $_POST['slider_id'];
        $slider_title = trim($_POST['slider_title']);
        $slider_image = $_POST['slider_image']; // Assuming image path is sent

        $sql = "UPDATE slider SET title=?, image=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $slider_title, $slider_image, $slider_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Slider updated successfully.'); window.location.href='manage_slider.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error updating slider.'); window.location.href='manage_slider.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Error preparing SQL query.'); window.location.href='manage_slider.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href='manage_slider.php';</script>";
        exit;
    }
}

if (isset($_GET['id'])) {
    $slider_id = $_GET['id'];
    $sql = "SELECT * FROM slider WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $slider_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $slider_title = $row['title'];
            $slider_image = $row['image'];

        } else {
            echo "<script>alert('No slider found with that ID.'); window.location.href='manage_slider.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error preparing SQL query.'); window.location.href='manage_slider.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('No slider ID provided.'); window.location.href='manage_slider.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Slider - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">
    <h2>Edit Slider</h2>
    <form action="edit_slider.php" method="POST">
        <input type="hidden" name="slider_id" value="<?= $slider_id; ?>">
        <div class="mb-3">
            <label for="slider_title" class="form-label">Slider Title</label>
            <input type="text" class="form-control" id="slider_title" name="slider_title" value="<?= htmlspecialchars($slider_title); ?>" required>
        </div>
        <div class="mb-3">
            <label for="slider_image" class="form-label">Slider Image URL</label>
            <input type="text" class="form-control" id="slider_image" name="slider_image" value="<?= htmlspecialchars($slider_image); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Slider</button>
    </form>
</div>

<?php include 'partials/footer.php'; ?>