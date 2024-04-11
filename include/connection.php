<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log_in_system";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Connection Failed!"; 
}
// else {

//     session_start();
    
//     $user_id = $_SESSION['id'];
//     $get_user_role = "SELECT * FROM register WHERE id='{$user_id}'";
//     $run_q = mysqli_query($conn, $get_user_role);
//     $fetch_arr = mysqli_fetch_array($run_q);
    
//     if(isset($_SESSION['id'])) {
//         if ($fetch_arr['user_role'] == 'admin') {
//             header("Location: ./pages/user_records.php");
//         } else {
//             header("Location: ./pages/user_profile.php");
//         }
//     } else {
//         header("Location: ./index.php");
//     }
// }

?>