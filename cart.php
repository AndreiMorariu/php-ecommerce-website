<div class="container">
    <div class="cart">
        <h2>Your cart</h2>
        <table>
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total price</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    if (mysqli_num_rows($result) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($result)) {
                    ?>
                <tr>
                    <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                    <td>
                        <?php echo $fetch_cart['name']; ?>
                    </td>
                    <td>
                        <?php echo $fetch_cart['price'] . "&euro;"; ?>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                            <input type="number" min="1" name="cart_quantity"
                                value="<?php echo $fetch_cart['quantity']; ?>">
                            <input type="submit" name="update_cart" value="update"
                                class="option-btn btn btn-primary btn-sm">
                        </form>
                    </td>
                    <td>
                        <?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']) ?> &euro;
                    </td>
                    <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="btn btn-warning">Remove</a>
                    </td>
                </tr>
                <?php
                            $total += $fetch_cart['price'] * $fetch_cart['quantity'];
                        }
                    } else {
                        echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
                    }
                    ?>
                <tr class="table-bottom">
                    <td colspan="4"><span class="text-bold">Total :</span></td>
                    <td>
                        <?php echo $total . "&euro;"; ?>
                    </td>
                    <td><a href="index.php?delete_all"
                            class="btn btn-danger <?php echo ($total > 1) ? '' : 'disabled'; ?>">Delete
                            all</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="cart-button d-flex justify-content-center">
            <a href="#" class="btn btn-primary p-3 text-uppercase m-4">Proceed to Checkout</a>
        </div>
    </div>
</div>