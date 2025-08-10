<?php include 'partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LifeSaver Blood Bank - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
  <div class="text-center">
    <h1 class="text-danger">Welcome to LifeSaver Blood Bank</h1>
    <p class="lead">Donate Blood, Save Lives</p>
  </div>

  <div class="row mt-5">
    <div class="col-md-4">
      <div class="card border-danger">
        <div class="card-body">
          <h5 class="card-title text-danger">Available Blood</h5>
          <p class="card-text">Check current availability of blood by group.</p>
          <a href="report.php" class="btn btn-danger">Check Report</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success">
        <div class="card-body">
          <h5 class="card-title text-success">Upcoming Camps</h5>
          <p class="card-text">View all upcoming blood donation events.</p>
          <a href="#" class="btn btn-success">View Events</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-warning">
        <div class="card-body">
          <h5 class="card-title text-warning">Request Blood</h5>
          <p class="card-text">Need urgent blood? Request here.</p>
          <a href="#" class="btn btn-warning text-white">Request Now</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
