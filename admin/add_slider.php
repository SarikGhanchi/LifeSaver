<?php
session_start();
include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['slider_title'], $_FILES['slider_image'])) {
        $slider_title = trim($_POST['slider_title']);
        $slider_image = $_FILES['slider_image']['name'];
        $target_dir = "../uploads/"; // uploads folder at project root
        $imageFileType = strtolower(pathinfo($slider_image, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Generate unique file name
        $new_filename = uniqid('slider_', true) . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['slider_image']['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File is not an image.'); window.location.href='manage_slider.php';</script>";
            $uploadOk = 0;
        }

        // Check file size (max 2MB)
        if ($_FILES['slider_image']['size'] > 2 * 1024 * 1024) {
            echo "<script>alert('Sorry, your file is too large.'); window.location.href='manage_slider.php';</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href='manage_slider.php';</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES['slider_image']['tmp_name'], $target_file)) {
                // Save only the file name in DB, not the path
                $sql = "INSERT INTO slider (title, image) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $slider_title, $new_filename);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>alert('Slider added successfully.'); window.location.href='manage_slider.php';</script>";
                        exit;
                    } else {
                        echo "<script>alert('Error adding slider.'); window.location.href='manage_slider.php';</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Error preparing SQL query.'); window.location.href='manage_slider.php';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href='manage_slider.php';</script>";
                exit;
            }
        }
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href='manage_slider.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Slider - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">
    <h2 class="text-danger">Add New Slider</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="slider_title" class="form-label">Slider Title</label>
            <input type="text" class="form-control" id="slider_title" name="slider_title" required>
        </div>
        <div class="mb-3">
            <label for="slider_image" class="form-label">Slider Image</label>
            <input type="file" class="form-control" id="slider_image" name="slider_image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Slider</button>
    </form>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>