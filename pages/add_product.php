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
        <title>Add New Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        
        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">
                
                <div class="col-lg-12">
                    <h1 class="text-center" style="color: #30f;">Add Product</h1>
                </div>

                <div class="col-lg-12">
                    <form action="../php/add_new_product.php" method="POST">

                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="p_name" class="form-control" placeholder="Enter product name...">
                        </div>
                        <div class="mb-3">
                            <label>Product Description</label>
                            <textarea type="text" name="p_desc" class="form-control" rows="10" cols="30" placeholder="Enter product description..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Product Price</label>
                            <input type="number" name="p_price" class="form-control" placeholder="Enter product price...">
                        </div>

                        <button class="btn btn-dark" type="submit">Add</button>
                        <button class="btn btn-primary" type="button" onclick="backFunc()">Back</button>

                    </form>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function backFunc() {
                window.history.back()
            }
        </script>
    </body>
</html>
