<?php

require '../include/connection.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ./login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shop | Products</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row" id="product_row">

                <div class="col-lg-12">
                    <h1 class="text-center" style="color: orange;">Shop</h1>
                </div>

                <div class="col-lg-12 mt-3 mb-3 d-flex justify-content-center align-items-center" id="button_box">
                    <button class="btn btn-primary mx-3"><a href="./display_cart.php" style="text-decoration: none;color: #fff;">Shwo Cart</a></button>
                    <button class="btn btn-dark mx-3" type="button" onclick="backFunc()">Back</button>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script>

            $(document).ready(() => {
                displayProduct()
            })

            function displayProduct() {
                $.ajax({
                    type: 'GET',
                    url: './api/shop_display.php',
                    contentType: "application/json",
                    mimeType : "json",
                    success: function (res) {
                        $.each(res, function (key, val) {
                            $("#button_box").before(
                                '<div class="col-lg-3 mt-3 mb-3">\
                                    <div class="product-box h-100 border shadow p-2 d-flex justify-content-center align-items-center flex-column" style="border-radius: 12px;">\
                                        <div class="heading d-flex justify-content-between align-items-center" style="width: 100%;height: 20%;">\
                                            <h5 style="color: #30f;font-weight: 700;">' + val['product_name'] + '</h5>\
                                            <span style="color: orange;font-weight: 500;">Seller: ' + val['seller_name'] + '</span>\
                                        </div>\
                                        <div class="product-wrap" style="width: 100%;height: 60%;">\
                                            <p style="color: #000;font-weight: 500;">' + val['product_description'] + '</p>\
                                        </div>\
                                        <div class="product-footer d-flex justify-content-between align-items-center" style="width: 100%;height: 15%;">\
                                            <span style="color: green;font-weight: 600;">$' + val['product_price'] + '</span>\
                                            <span style="font-weight: 600;">' + val['product_date'] + '</span>\
                                        </div>\
                                        <div class="btn-box d-flex justify-content-center align-items-center" style="width: 100%;height: 20%;">\
                                            <button class="btn btn-warning mx-1"><a href="../php/add_cart.php?productid=' + val['product_id'] + '" style="text-decoration: none;color: #000;">Add to Cart</a></button>\
                                            <button class="btn btn-success mx-1">Buy Now</button>\
                                        </div>\
                                    </div>\
                                </div>\
                                '
                            )
                        })
                    }
                })
            }

            function backFunc() {
                window.history.back()
            }
        </script>
    </body>
</html>
