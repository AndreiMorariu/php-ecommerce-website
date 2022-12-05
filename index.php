<?php
include 'db.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
;

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}
;

if (isset($_POST['add'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart!';
    } else {
        mysqli_query($con, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
    }

}
;

if (isset($_POST['update_cart'])) {
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    $query = "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'";
    $result = mysqli_query($con, $query);
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $query = "DELETE FROM `cart` WHERE id = '$remove_id'";
    $result = mysqli_query($con, $query);
    header('location:index.php');
}

if (isset($_GET['delete_all'])) {
    $query = "DELETE FROM `cart` WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>shopping cart</title>
</head>

<body>
    <?php
    if (isset($message)) {
        echo "<div class='alert alert-danger' role='alert'>";
        foreach ($message as $msg) {
            echo $msg;
        }
        echo "</div>";
    }
    ?>

    <nav>
        <div class="user-profile">
            <?php
            $query = "SELECT * FROM users WHERE id = '$user_id'";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($result) > 0) {
                $fetch_user = mysqli_fetch_assoc($result);
            }
            ?>
            <p>username :
                <span>
                    <?php echo $fetch_user['name']; ?>
                </span>
            </p>
            <p>email :
                <span>
                    <?php echo $fetch_user['email']; ?>
                </span>
            </p>
        </div>
        <div>
            <ul class="nav-links">
                <li><a href="admin/login.php" class="admin">Admin</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="index.php?logout=<?php echo $user_id; ?>" class="logout">Logout</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <h1 class="text-center pb-2 display-6">Products</h1>
        <div class="products">
            <div class="container">
                <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                if (mysqli_num_rows($result) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($result)) {
                ?>
                <form action="" method="post" class="box">
                    <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
                    <div class="name">
                        <?php echo $fetch_product['name']; ?>
                    </div>
                    <div class="description">
                        <?php echo $fetch_product['description']; ?>
                    </div>
                    <div class="price">
                        <?php echo $fetch_product['price'] . " &euro;"; ?>
                    </div>
                    <input type="number" min="1" name="product_quantity" value="1">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                    <input type="submit" value="add to cart" name="add" class="btn btn-primary">
                </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <?php include "cart.php" ?>
</body>

</html>