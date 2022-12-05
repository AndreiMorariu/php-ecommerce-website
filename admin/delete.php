<?php
include "../db.php";
$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$query = "DELETE FROM `products` WHERE id = $id";
$result = mysqli_query($con, $query);
if ($result) {
    header('Location: index.php');
    exit;
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
}