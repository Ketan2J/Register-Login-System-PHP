<?php

require '../include/connection.php';
session_start();

$userid = $_SESSION['id'];

$product_name = $_POST['p_name'];
$product_desc = $_POST['p_desc'];
$product_price = $_POST['p_price'];
$product_date = date('Y-m-d');

$insert_product = "INSERT INTO product (admin_id, product_name, product_description, product_price, product_date) VALUE ('$userid', '$product_name', '$product_desc', '$product_price', '$product_date')";
$run_query = mysqli_query($conn, $insert_product);

if ($run_query) {
    header("Location: ../pages/add_product.php");
} else {
    echo "Failed!";
}

?>