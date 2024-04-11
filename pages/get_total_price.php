<?php

require '../include/connection.php';
session_start();

$get_user_id = $_SESSION['id'];
$get_all_cart = "SELECT * FROM cart WHERE 	user_ID='{$get_user_id}'";
$run_cart_q = mysqli_query($conn, $get_all_cart);
$rows = mysqli_num_rows($run_cart_q);

$arr = [];

if ($rows > 0) {
    while ($count_cart = mysqli_fetch_array($run_cart_q)) {
        $get_produc_detail = "SELECT * FROM product WHERE id='{$count_cart['product_id']}'";
        $run_product = mysqli_query($conn, $get_produc_detail);
        $get_product_arr = mysqli_fetch_array($run_product);

        $one_cart_price = $count_cart['quantity'] * $get_product_arr['product_price'];

        array_push($arr, $one_cart_price);
    }
    echo json_encode($arr);
}

?>
