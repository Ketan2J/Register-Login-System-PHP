<?php

require '../include/connection.php';
session_start();

$get_cart_id = $_GET['cartiD'];

$select_ = "SELECT * FROM cart WHERE id='{$get_cart_id}'";
$run_cart = mysqli_query($conn, $select_);
$rows = mysqli_num_rows($run_cart);

if ($rows > 0) {
    while ($get_data = mysqli_fetch_array($run_cart)) {

        $get_product_id = $get_data['product_id'];
        $get_product_price = "SELECT * FROM product WHERE id='{$get_product_id}'";
        $run_product = mysqli_query($conn, $get_product_price);
        $get_product_arr = mysqli_fetch_array($run_product);
        echo $get_product_arr['product_price'] * $get_data['quantity'];
    }
}

?>
