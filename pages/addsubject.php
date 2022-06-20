<?php
session_start();
require_once '../config.php';
$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Add subject</title>
</head>
<body>
  <form action="connexion.php" method="post" class="border shadow rounded p-5 was-validated">
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" require>
    <div class="invalid-feedback">Please enter a valid mail.</div>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" autocomplete="off" require>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php if (!isset($admin)) : ?> <a href="registe.php" class="btn btn-primary">Register</a><?php endif; ?>
</form>
</body>
</html>


