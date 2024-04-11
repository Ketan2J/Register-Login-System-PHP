<?php

require '../include/connection.php';
session_start();

$get_cart_id = $_GET['cart_ID'];

$delete_q = "DELETE FROM cart WHERE id='{$get_cart_id}'";
$run_del = mysqli_query($conn, $delete_q);

if ($run_del) {
    echo "Successfull..";
} else {
    echo "Failed..";
}

?>