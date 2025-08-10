<?php include 'partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - LifeSaver Blood Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <h2 class="text-center text-danger">Contact Us</h2>
  <form action="submit_contact.php" method="post" class="mt-4">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name:</label>
      <input type="text" class="form-control" name="name" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email address:</label>
      <input type="email" class="form-control" name="email" required>
    </div>

    <div class="mb-3">
      <label for="subject" class="form-label">Subject:</label>
      <input type="text" class="form-control" name="subject" required>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">Message:</label>
      <textarea class="form-control" name="message" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-danger">Send Message</button>
  </form>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
<?php
include 'partials/dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Message sent!'); window.location.href='contactus.php';</script>";
    } else {
        echo "<script>alert('Failed to send message.');</script>";
    }
}
?>