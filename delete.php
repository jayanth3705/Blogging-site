<?php
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM blogs WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
            exit;
        } else {
            echo "Something went wrong. Please try again later.";
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
  <title>Delete Blog</title>
  <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Confirm Delete</h2>
  <form method="post">
    <p>Are you sure you want to delete this blog?</p>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <a href="index.php" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</div>
<script src="assets/vendors/jQuery/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
</body>
</html>
