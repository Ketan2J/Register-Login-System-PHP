<?php

require '../../include/connection.php';
session_start();

$get_all_products = "SELECT * FROM product";
$run_all_product = mysqli_query($conn, $get_all_products);
$rows = mysqli_num_rows($run_all_product);

$product_array = array();

if ($rows > 0) {
    while ($get_prod = mysqli_fetch_assoc($run_all_product)) {

        $get_admin_id = $get_prod['admin_id'];

        $select_admin = "SELECT * FROM register WHERE id='{$get_admin_id}'";
        $run_admin = mysqli_query($conn, $select_admin);
        $get_admin = mysqli_fetch_array($run_admin);

        $product_array[] = array(
            'product_id' => $get_prod['id'],
            'seller_name' => $get_admin['username'],
            'product_name' => $get_prod['product_name'],
            'product_description' => $get_prod['product_description'],
            'product_price' => $get_prod['product_price'],
            'product_date' => $get_prod['product_date'],
        );
    }
    echo json_encode($product_array);
}

?>
