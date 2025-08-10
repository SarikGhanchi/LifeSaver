<?php
session_start();
include '../partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['slider_id'])) {
        $slider_id = $_POST['slider_id'];

        $sql = "DELETE FROM slider WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $slider_id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Slider deleted successfully.'); window.location.href='manage_slider.php';</script>";
            } else {
                echo "<script>alert('Error deleting slider. Please try again.'); window.location.href='manage_slider.php';</script>";
            }
        } else {
            echo "<script>alert('Error preparing SQL query.'); window.location.href='manage_slider.php';</script>";
        }
    } else {
        echo "<script>alert('No slider ID provided.'); window.location.href='manage_slider.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method.'); window.location.href='manage_slider.php';</script>";
}
?>