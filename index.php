<?php
require_once 'connection.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Blog Management System</title>
  <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="assets/vendors/font-awesome/css/all.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a href="#" class="navbar-brand">
      <img src="img/img1.jpg" alt="Logo" width="40" class="img-fluid">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
      <div class="navbar-nav ms-auto">Blogs</div>
    </div>
  </div>
</nav>

<div class="container p-5">
  <div class="mb-3">
    <a href="create.php" class="btn btn-outline-primary">ADD BLOGS</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Added On</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM blogs";
          if ($result = mysqli_query($link, $sql)) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>{$row['id']}</td>";
                  echo "<td>" . htmlspecialchars($row['blog_name']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['blog_content']) . "</td>";
                  echo "<td>" . date('d-m-Y', strtotime($row['blog_added_on'])) . "</td>";
                  echo "<td>
                          <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                          <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
                        </td>";
                  echo "</tr>";
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="assets/vendors/jQuery/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
</body>
</html>
