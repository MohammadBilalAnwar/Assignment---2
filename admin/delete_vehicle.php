<?php
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}
if(isset($_GET['delete_vehicle'])){
    $del_id = $_GET['delete_vehicle'];
    $delete_vehicle = "delete from vehicle where v_id='$del_id'";
    $run_del = mysqli_query($con,$delete_vehicle);
    if($run_del){
        header('location: admin.php?view_vehicles');
    }
}