<?php

require_once '../include/connection.php';
session_start();
if(isset($_POST['reset_btn'])) {
    $oldPwd = $_POST['old_pawd'];
    $newPwd = $_POST['new_pawd'];

    $hash_old_password = password_hash($oldPwd, PASSWORD_DEFAULT);
    $hash_new_password = password_hash($newPwd, PASSWORD_DEFAULT);

    $user_id = $_SESSION['id'];

    $select_q = "SELECT * FROM register WHERE id='{$user_id}'";
    $query_s = mysqli_query($conn, $select_q);

    $col_num = mysqli_num_rows($query_s);

    $result = mysqli_fetch_array($query_s);
    $oldPass = $result['password'];

    if ($col_num > 0) {
        $update_q = "UPDATE register SET password='{$hash_new_password}' WHERE id='{$result['id']}'";
        $query_u = mysqli_query($conn, $update_q);
        if ($newPwd == $oldPass) {
            echo "Old Password & New Password is same!";
        } else if (password_verify($hash_old_password, $result['password'])) {
            echo "Entered old password is not match!";
        } else if ($query_u) {
            if ($result['user_role'] == 'admin') {
                echo "
                    <script>
                        alert('Password is changed!');
                    </script>
                "; 
                header("Location: ../pages/user_records.php");
            } else if ($result['user_role'] == 'user') {
                echo "
                    <script>
                        alert('Password is changed!');
                    </script>
                ";
                header("Location: ../pages/user_profile.php");
            }
        }
    }
}

?>
