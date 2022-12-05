<?php include "../db.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$query = "SELECT * FROM `products` WHERE id = $id";
$result = mysqli_query($con, $query);
$product = mysqli_fetch_assoc($result);

$name = $product['name'];
$description = $product['description'];
$price = $product['price'];
$image = $product['image'];
$category = $product['categorie'];

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    if ($product['image']) {
        unlink($product['image']);
    }

    $query = "UPDATE products SET name = '$name', description = '$description', price = '$price', image = '$image', categorie = '$category' WHERE id = $id";
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
    <a href="index.php">Go back to products</a>


    <h1 class="text-center pb-5">Update Product:
        <?php echo $product['name'] ?>
    </h1>
    <?php
    if ($product['image']) {
    ?>
    <img src="../images/<?php echo $product['image'] ?>" alt="" height="100">
    <?php
    }
    ?>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <input type="text" class="form-control" name="description" value="<?php echo $description ?>">
        </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control" name="price" value="<?php echo $price ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Product image</label>
            <input type="file" class="form-control" name="image" value="<?php echo $image ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Product categorie</label>
            <input type="text" class="form-control" name="category" value="<?php echo $category ?>">
        </div>
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
    </form>
</body>

</html>