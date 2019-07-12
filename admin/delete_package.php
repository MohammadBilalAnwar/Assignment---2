<?php
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}
if(isset($_GET['delete_package'])){
    $del_id = $_GET['delete_package'];
    $delete_package = "delete from vehicle where p_id='$del_id'";
    $run_del = mysqli_query($con,$delete_package);
    if($run_del){
        header('location: admin.php?view_vehicles');
    }
}