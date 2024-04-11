<?php

require '../include/connection.php';
session_start();

$get_userid = $_SESSION['id'];
$get_productid = $_GET['productid'];

$select_cart = "SELECT * FROM cart WHERE user_ID='{$get_userid}'";
$run_cart_id = mysqli_query($conn, $select_cart);
$get_user_cart_arr = mysqli_fetch_array($run_cart_id);

$str_to_int = intval($get_user_cart_arr['quantity']);

$quantity_add = 1 + $str_to_int;

if ($get_user_cart_arr['product_id'] != $get_productid) {

    $qua = 1;
    $insert_new_product = "INSERT INTO cart (user_ID, product_id, quantity) VALUES ('$get_userid', '$get_productid', '$qua')";
    $run_new_cart = mysqli_query($conn, $insert_new_product);
    
    if ($run_new_cart) {
        echo "new OK";
    } else {
        echo "new NO";
    }
    
} else {

    $update_quantity = "UPDATE cart SET quantity='{$quantity_add}' WHERE product_id='{$get_productid}'";
    $run_u_cart = mysqli_query($conn, $update_quantity);
    
    if ($run_u_cart) {
        echo "OK";
    } else {
        echo "NO";
    }

}

?>
