<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: adminlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "navbar.php"; ?>

<div class="container mt-4">
    <h2>Profile</h2>
    <img src="data:image/png;base64,<?= $_SESSION["image"] ?>" width="120" class="rounded-circle mb-3">
    <p><strong>Name:</strong> <?= $_SESSION["fullname"] ?></p>
    <p><strong>Email:</strong> <?= $_SESSION["email"] ?? 'Hidden' ?></p>
    <p><strong>Role:</strong> <?= $_SESSION["role"] ?></p>
</div>
</body>
</html>
