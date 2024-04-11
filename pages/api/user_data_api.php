<?php

require '../../include/connection.php';

$select_all = "SELECT * FROM register";
$run_all = mysqli_query($conn, $select_all);
$get_rows = mysqli_num_rows($run_all);

$new_array = array();
$user_arr = array();

if ($get_rows > 0) {
    while ($get_array = mysqli_fetch_array($run_all)) {
        $new_array[] = array(
            'user_id' => $get_array['id'],
            'userName' => $get_array['username'],
            'mobilenumber' => $get_array['mobileno'],
            'emailAdd' => $get_array['email'],
            'address' => $get_array['city'],
            'userrole' => $get_array['user_role']
        );
        $user_arr[] = array(
            'userName' => $get_array['username'],
        );
    }

    $fp_ = fopen('udata.json', 'w');
    fwrite($fp_, json_encode($new_array));
    fclose($fp_);

    $fp_1 = fopen('user.json', 'w');
    fwrite($fp_1, json_encode($user_arr));
    fclose($fp_1);

    echo json_encode($new_array);
}

?>
