<?php include "../db.php";

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
    <h1 class="text-center pb-5">Products CRUD</h1>
    <a href="create.php" class="btn btn-lg btn-success">Create Product</a>
    <a href="../index.php" class="btn btn-lg btn-warning text-white">Inapoi la user</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">description</th>
                <th scope="col">price</th>
                <th scope="col">image</th>
                <th scope="col">categorie</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($fetch_product = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <th scope="row">
                    <?php echo $i++ ?>
                </th>
                <td>
                    <?php echo $fetch_product['name'] ?>
                </td>
                <td>
                    <?php echo $fetch_product['description'] ?>
                </td>
                <td>
                    <?php echo $fetch_product['price'] ?>
                </td>
                <td>
                    <?php echo $fetch_product['image'] ?>
                </td>
                <td><img src="../images/<?php echo $fetch_product['image']; ?>" height="100" alt=""></td>
                <td>
                    <?php echo $fetch_product['categorie'] ?>
                </td>
                <td>
                    <a href="update.php?id=<?php echo $fetch_product['id'] ?>"
                        class="btn btn-sm btn-outline-warning">Edit</a>
                    <form style="display: inline-block" action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $fetch_product['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>