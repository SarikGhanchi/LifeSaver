<?php include 'partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blood Report - LifeSaver Blood Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <h2 class="text-center text-danger">Available Blood Stock</h2>
  <table class="table table-bordered mt-4">
    <thead class="table-danger">
      <tr>
        <th>#</th>
        <th>Blood Group</th>
        <th>Quantity (Units)</th>
        <th>Last Updated</th>
      </tr>
    </thead>
    <tbody>
      <!-- You will dynamically fill this with PHP -->
      <tr>
        <td>1</td>
        <td>A+</td>
        <td>10</td>
        <td>2025-07-24</td>
      </tr>
      <tr>
        <td>2</td>
        <td>O-</td>
        <td>3</td>
        <td>2025-07-23</td>
      </tr>
    </tbody>
  </table>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
