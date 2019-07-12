<?php
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}
if(isset($_GET['delete_hotel'])){
    $delId = $_GET['delete_hotel'];
    $delete_hotel = "delete from hotel where h_id='$delId'";
    $run_del = mysqli_query($con,$delete_hotel);
    if($run_del){
        header('location: admin.php?view_hotel');
    }
}