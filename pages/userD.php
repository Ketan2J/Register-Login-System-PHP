<?php

require '../include/connection.php';
session_start();

$get_user_data = "SELECT * FROM register";
$run_q = mysqli_query($conn, $get_user_data);
$rows = mysqli_num_rows($run_q);
$arr = [];

if ($rows > 0) {
    while ($get_u_arr = mysqli_fetch_array($run_q)) {
        $d = "
            <tr>
                <td>{$get_u_arr['username']}</td>
                <td>{$get_u_arr['email']}</td>
                <td>{$get_u_arr['mobileno']}</td>
                <td>{$get_u_arr['city']}</td>
                <td>{$get_u_arr['user_role']}</td>
            </tr>
        ";
        array_push($arr, $get_u_arr);
    }
    header('Content-type: application/json');
    echo json_encode($arr);
}

?>