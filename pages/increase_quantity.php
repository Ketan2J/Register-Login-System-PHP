<?php

require '../include/connection.php';
session_start();

$get_cart_id = $_GET['cartID'];

$select_cart = "SELECT * FROM cart WHERE id='{$get_cart_id}'";
$run_car = mysqli_query($conn, $select_cart);
$rows = mysqli_num_rows($run_car);

if ($rows > 0) {
    while ($count_rows = mysqli_fetch_assoc($run_car)) {

        $old_quantity = $count_rows['quantity'];
        $new_quantity = $old_quantity + 1;

        $dec_update_cart_q = "UPDATE cart SET quantity='{$new_quantity}' WHERE id='{$count_rows['id']}'";
        $run_update = mysqli_query($conn, $dec_update_cart_q);

        if ($run_update) {
            echo $new_quantity;
        } else {
            echo "Failed...!";
        }

    }
}

?>
