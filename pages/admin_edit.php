<?php

require '../include/connection.php';
session_start();
if(!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Edit Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        
        <!-- Menu Bar -->
        <?php include '../include/menubar.php'; ?>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 d-flex justify-content-center align-items-center">
                    <h1 class="text-primary">Edit User Details</h1>
                </div>

                <div class="col-lg-12">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <?php

                            $edit_user_id = $_GET['user_ID'];
                            $select_user_data = "SELECT * FROM register WHERE id='{$edit_user_id}'";
                            $run_q = mysqli_query($conn, $select_user_data);
                            $rows = mysqli_num_rows($run_q);

                            $get_user_detail = mysqli_fetch_array($run_q);

                            if ($get_user_detail['user_role'] == 'user') {
                                echo '
                                    <div class="mb-3">
                                        <input type="hidden" name="uid" class="form-control" placeholder="Edit Name" value="' . $get_user_detail['id'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User Name</label>
                                        <input type="text" name="uname" class="form-control" placeholder="Edit Name" value="' . $get_user_detail['username'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">E-Mail Address</label>
                                        <input type="email" name="uemail" class="form-control" placeholder="Edit Email" value="' . $get_user_detail['email'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User Mobile Number</label>
                                        <input type="number" name="umobileno" class="form-control" placeholder="Edit Mobile Number" value="' . $get_user_detail['mobileno'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User City</label>
                                        <input type="text" name="ucity" class="form-control" placeholder="Edit City" value="' . $get_user_detail['city'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User Role</label>
                                        <select class="form-select" name="user_Role" aria-label="Default select example">
                                            <option value="user" selected>User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                ';
                            } else if ($get_user_detail['user_role'] == 'admin') {
                                echo '
                                    <div class="mb-3">
                                        <input type="hidden" name="uid" class="form-control" placeholder="Edit Name" value="' . $get_user_detail['id'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User Name</label>
                                        <input type="text" name="uname" class="form-control" placeholder="Edit Name" value="' . $get_user_detail['username'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">E-Mail Address</label>
                                        <input type="email" name="uemail" class="form-control" placeholder="Edit Email" value="' . $get_user_detail['email'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User Mobile Number</label>
                                        <input type="number" name="umobileno" class="form-control" placeholder="Edit Mobile Number" value="' . $get_user_detail['mobileno'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User City</label>
                                        <input type="text" name="ucity" class="form-control" placeholder="Edit City" value="' . $get_user_detail['city'] . '">
                                    </div>
                                    <div class="mb-3">
                                        <label style="font-weight: 700;font-size: 20px;">User Role</label>
                                        <select class="form-select" name="user_Role" aria-label="Default select example">
                                            <option value="user">User</option>
                                            <option value="admin" selected>Admin</option>
                                        </select>
                                    </div>
                                ';
                            }

                        ?>
                        <button class="btn btn-primary" name="update-particular-user">UPDATE</button>
                        <button class="btn btn-danger" type="button" onclick="backFunc()">CANCEL</button>
                    </form>

                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            function backFunc(){
                window.history.back()
            }
        </script>
    </body>
</html>

<?php

    if (isset($_POST['update-particular-user'])) {
        $get_user_id = $_POST['uid'];
        $get_user_name = $_POST['uname'];
        $get_user_email = $_POST['uemail'];
        $get_user_mobile_no = $_POST['umobileno'];
        $get_user_city = $_POST['ucity'];
        $get_user_role = $_POST['user_Role'];

        $update_user_query = "UPDATE register SET username='$get_user_name', mobileno={$get_user_mobile_no}, email='{$get_user_email}', city='{$get_user_city}', user_role='{$get_user_role}' WHERE id='{$get_user_id}'";
        $run_query = mysqli_query($conn, $update_user_query);
        
        if ($run_query) {
            $msg = "Record Updated Successfully!"; 
            header("Location: ./user_records.php?updateAdmin=$msg");
            exit;
        }
    }

?>
