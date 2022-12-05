<?php include "../db.php";

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    $query = "INSERT INTO products (name, description, price, image, categorie) VALUES ('$name', '$description', '$price', '$image', '$category')";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if ($result) {
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Admin</title>
</head>

<body class="p-5">
    <h1 class="text-center pb-5">Create New Product</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <input type="text" class="form-control" name="description">
        </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control" name="price">
        </div>
        <div class="mb-3">
            <label class="form-label">Product image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <label class="form-label">Product categorie</label>
            <input type="text" class="form-control" name="category">
        </div>
        <button type="submit" name="create" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>