<?php include 'partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Blood Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5" style="max-width: 400px;">
  <h3 class="text-center text-danger">Admin Login</h3>
  <form action="admin/admin_login.php" method="POST">
    <div class="mb-3">
      <label class="form-label">Username:</label>
      <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password:</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-danger w-100">Login</button>
  </form>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
