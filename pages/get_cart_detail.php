<?php

require '../include/connection.php';
session_start();

$user_id = $_SESSION['id'];

$select_cart = "SELECT * FROM cart WHERE user_ID='{$user_id}'";
$run_cart = mysqli_query($conn, $select_cart);
$rows = mysqli_num_rows($run_cart);

$get_cart_info = array();

if ($rows > 0) {
    while ($count_cart = mysqli_fetch_assoc($run_cart)) {
        $product_id = $count_cart['product_id'];
        $select_product = "SELECT * FROM product WHERE id='{$product_id}'";
        $run_product = mysqli_query($conn, $select_product);

        while ($get_product_arr = mysqli_fetch_assoc($run_product)) {

            $one_cart_price = $count_cart['quantity'] * $get_product_arr['product_price'];

            $get_cart_info[] = array(
                'cart_id' => $count_cart['id'],
                'product_id' => $product_id,
                'product_name' => $get_product_arr['product_name'],
                'product_price' => $get_product_arr['product_price'],
                'product_quantity' => $count_cart['quantity'],
                'one_product_price' => $one_cart_price
            );
            
        }
    }
    echo json_encode($get_cart_info);
}

?>
