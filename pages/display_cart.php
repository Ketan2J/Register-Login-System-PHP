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
        <title>My Cart</title>
    </head>
    <body>

        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 mt-3 mb-3" id="main_cart"></div>

                <div class="col-lg-12 my-2 p-3" style="background-color: #e5e5e5;border-radius:15px;">

                    <div class="total" style="position:relative;">
                        <button class="btn btn-primary" style="margin:auto;position:absolute;">Buy</button>
                        <span style="float:right;font-size:20px;color:$30f;font-weight:500;" id="total_price">Total: $' . $total_p . '</span>
                    </div>
                
                </div>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script>

            $(document).ready( function() {

                // Get All cart detail
                getAllCartData ()

                // Get Total Price of all cart
                getTotalPrice()

            })

            function getAllCartData() {
                $.ajax({
                    type: 'POST',
                    url: "get_cart_detail.php",
                    contentType: "application/json",
                    dataType : "json",
                    success: function (res) {
                        $.each(res, function(key, val) {
                            if (val['product_quantity'] == '1') {
                                $("#main_cart").append(
                                    '<div id="main_cart_ID' + val['cart_id'] + '" class="cart-box shadow my-2 p-2 d-flex justify-content-between align-items-center" style="background-color:rgba(255, 255, 255, 0.7);border:1.5px solid #000;border-radius: 20px;">\
                                        <div>\
                                            <p style="font-size:22px;font-weight:500;color:orange;">' + val['product_name'] + '</p>\
                                            <p class="text-success" style="font-size:16px;font-weight:600;">$' + val['product_price'] + '</p>\
                                        </div>\
                                        <div style="position:relative;">\
                                            <button class="btn btn-danger" style="position:absolute;right:-2%;border-radius:50%;font-size:13px;padding:2px 7px;" onclick="deleteCart(' + val['cart_id'] + ')">X</button>\
                                            <p style="font-size:18px;color:green;font-weight:700;" id="one_p' + val['cart_id'] + '">$' + val['one_product_price'] + '</p>\
                                            <div>\
                                                <button class="btn btn-light" id="dec_btn' + val['cart_id'] + '" onclick="decQuaFunc(' + val['cart_id'] + ')" style="border:1px solid #000;fontsize: 20px;color:#000;font-weight:700;" disabled>-</button>\
                                                <p class="btn btn-light" id="disp_qu' + val['cart_id'] + '" style="margin-top:0%;">' + val['product_quantity'] + '</p>\
                                                <button class="btn btn-light" id="inc_btn" onclick="incQuaFunc(' + val['cart_id'] + ')" style="border:1px solid #000;fontsize: 20px;color:#000;font-weight:700;">+</button>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <hr id="hr_line' + val['cart_id'] + '">'
                                );
                            } else {
                                $("#main_cart").append(
                                    '<div id="main_cart_ID' + val['cart_id'] + '" class="cart-box shadow my-2 p-2 d-flex justify-content-between align-items-center" style="background-color:rgba(255, 255, 255, 0.7);border:1.5px solid #000;border-radius: 20px;">\
                                        <div>\
                                            <p style="font-size:22px;font-weight:500;color:orange;">' + val['product_name'] + '</p>\
                                            <p class="text-success" style="font-size:16px;font-weight:600;">$' + val['product_price'] + '</p>\
                                        </div>\
                                        <div style="position:relative;">\
                                            <button class="btn btn-danger" style="position:absolute;right:-2%;border-radius:50%;font-size:13px;padding:2px 7px;" onclick="deleteCart(' + val['cart_id'] + ')">X</button>\
                                            <p style="font-size:18px;color:green;font-weight:700;" id="one_p' + val['cart_id'] + '">$' + val['one_product_price'] + '</p>\
                                            <div>\
                                                <button class="btn btn-light" id="dec_btn' + val['cart_id'] + '" onclick="decQuaFunc(' + val['cart_id'] + ')" style="border:1px solid #000;fontsize: 20px;color:#000;font-weight:700;">-</button>\
                                                <p class="btn btn-light" id="disp_qu' + val['cart_id'] + '" style="margin-top:0%;">' + val['product_quantity'] + '</p>\
                                                <button class="btn btn-light" id="inc_btn" onclick="incQuaFunc(' + val['cart_id'] + ')" style="border:1px solid #000;fontsize: 20px;color:#000;font-weight:700;">+</button>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <hr id="hr_line' + val['cart_id'] + '">'
                                );
                            }
                            
                        })
                    }
                })
            }

            function getTotalPrice() {
                $.ajax({
                    type: 'POST',
                    url: "get_total_price.php",
                    contentType: "application/json",
                    dataType : "json",
                    success: function (res) {
                        if (res == "") {
                            $("#total_price").text("No Cart!");
                        } else {
                            $a = 0;
                            $a1 = 0;
                            $.each(res, function (key, val) {
                                $a = parseInt(val);
                                $a1 += $a; 
                            })
                            $("#total_price").text("Total: $" + $a1);
                        }
                        
                    }
                })
            }

            function incQuaFunc(cID) {
                var getBtn = document.getElementById('dec_btn' + cID);
                var pTag = document.getElementById('disp_qu'+cID);
                var oneProduct = document.getElementById('one_p'+cID);
                $.ajax({
                    type: 'POST',
                    url: './increase_quantity.php?cartID='+cID,
                    success: function(res) {
                        if (res >= '1') {
                            getBtn.disabled = false;
                            pTag.innerText = res;
                            $.ajax({
                                type: 'POST',
                                url: './get_one_p_price.php?cartiD=' + cID,
                                contentType: "application/json",
                                dataType : "json",
                                success: function(res1) {
                                    oneProduct.innerText = "$" + res1;
                                }
                            })
                            getTotalPrice(cID);
                        }
                        
                    }
                })
            }

            function decQuaFunc(cID) {
                var pTag = document.getElementById('disp_qu'+cID);
                var oneProduct = document.getElementById('one_p'+cID);
                var getBtn = document.getElementById('dec_btn' + cID);
                $.ajax({
                    type: 'POST',
                    url: './decrease_quantity.php?cartID='+cID,
                    success: function(res) {
                        if (res == '1') {
                            getBtn.disabled = true;
                        } else {
                            getBtn.disabled = false;
                            pTag.innerText = res;
                            $.ajax({
                                type: 'POST',
                                url: './get_one_p_price.php?cartiD=' + cID,
                                contentType: "application/json",
                                dataType : "json",
                                success: function(res1) {
                                    oneProduct.innerText = "$" + res1;
                                }
                            })
                            getTotalPrice(cID);
                        }
                    }
                })
            }

            function deleteCart(cartid) {
                var cartBoxID = document.getElementById('main_cart_ID' + cartid);
                var hr = document.getElementById('hr_line' + cartid);
                $.ajax({
                    type: 'POST',
                    url: './delete_cart.php?cart_ID='+cartid,
                    success: function(res) {
                        cartBoxID.remove();
                        hr.remove();
                        getTotalPrice(cartid);
                    }
                })
            }

            function backFunc() {
                window.history.back()
            }
            
        </script>

    </body>
</html>
