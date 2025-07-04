<?php
require_once 'connection.php';
$blog_name = $blog_content = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $blog_name = $_POST['blog_name'];
  $blog_content = $_POST['blog_content'];
  $blog_url = strtolower(str_replace(" ", "-", $blog_name));


  $sql = "INSERT INTO blogs (blog_name, blog_content, blog_url) VALUES (?, ?, ?)";
  if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "sss", $blog_name, $blog_content, $blog_url);
    if (mysqli_stmt_execute($stmt)) {
      header("location: index.php");
      exit;
    } else {
      echo "Something went wrong. Please try again.";
    }
    mysqli_stmt_close($stmt);
  }
}
mysqli_close($link);
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Create Blog</title>
  <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Create Blog</h2>
  <form method="post">
    <div class="mb-3">
      <label>Blog Name</label>
      <input type="text" name="blog_name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Blog Content</label>
      <textarea name="blog_content" class="form-control" rows="8" required></textarea>
    </div>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
<script src="assets/vendors/jQuery/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
</body>
</html>
