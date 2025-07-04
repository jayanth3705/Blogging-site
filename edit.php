<?php
require_once 'connection.php';
$blog_name = $blog_content = "";
$id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $blog_name = $_POST['blog_name'];
    $blog_content = $_POST['blog_content'];
    $blog_url = strtolower(str_replace(" ", "-", $blog_name));


    $sql = "UPDATE blogs SET blog_name = ?, blog_content = ?, blog_url = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $blog_name, $blog_content, $blog_url, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: edit.php?id=" . $id);
        exit;
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM blogs WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $blog_name = $row['blog_name'];
            $blog_content = $row['blog_content'];
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
  <title>Edit Blog</title>
  <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Edit Blog</h2>
  <form method="post">
    <div class="mb-3">
      <label>Blog Name</label>
      <input type="text" name="blog_name" class="form-control" value="<?php echo htmlspecialchars($blog_name); ?>" required>
    </div>
    <div class="mb-3">
      <label>Blog Content</label>
      <textarea name="blog_content" class="form-control" rows="8" required><?php echo htmlspecialchars($blog_content); ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <a href="index.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>
<script src="assets/vendors/jQuery/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
</body>
</html>
