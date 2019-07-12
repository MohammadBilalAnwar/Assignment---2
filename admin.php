<?php
session_start();
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}
require_once "db_con.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>TravRouter</title>
    <style>

    </style>
</head>
<body>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><img src="../media/logo.png"> Admin Panel</h3>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="index.php?insert_product">
                    <i class="fas fa-plus"></i> Add A Product
                </a>
            </li>
            <li>
                <a href="index.php?insert_vehicle.php">
                    <i class="fas fa-plus"></i> Add A Vehicle
                </a>
            </li>
            <li>
                <a href="index.php?update_vehicle">
                    <i class="fas fa-sitemap"></i> Update A Vehicle
                </a>
            </li>
            <li>
                <a href="index.php?delete_vehicle">
                    <i class="fas fa-sitemap"></i> Delete A Vehicle
                </a>
            </li>
            <li>
                <a href="index.php?insert_hotel">
                    <i class="fas fa-sitemap"></i> Add A Hotel
                </a>
            </li>
            <li>
                <a href="index.php?update_hotel">
                    <i class="fas fa-sitemap"></i> Update A Hotel
                </a>
            </li>
            <li>
                <a href="index.php?delete_hotel">
                    <i class="fas fa-sitemap"></i> Delete A Hotel
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out-alt"></i> Admin logout</a>
            </li>
        </ul>
    </nav>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
        <div class="container">
            <h2 class="text-center text-primary"><?php echo @$_GET['logged_in']?></h2>
            <?php
            if(isset($_GET['insert_vehicle'])){
                include ('insert_vehicle.php');
            }
            else if(isset($_GET['view_products'])){
                include ('view_vehicle.php');
            }
            else if(isset($_GET['edit_pro'])){
                include ('edit_pro.php');
            }
            else if(isset($_GET['del_pro'])){
                include ('delete_vehicle.php');
            }
            else if(isset($_GET['view_categories'])){
                include ('view_categories.php');
            }
            else if(isset($_GET['insert_category'])){
                include ('insert_category.php');
            }
            else if(isset($_GET['edit_cat'])){
                include ('edit_cat.php');
            }
            else if(isset($_GET['del_cat'])){
                include ('del_cat.php');
            }
            else if(isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            else if(isset($_GET['insert_brand'])) {
                include('insert_brand.php');
            }
            else if(isset($_GET['edit_brand'])) {
                include('edit_brand.php');
            }
            else if(isset($_GET['del_brand'])) {
                include('del_brand.php');
            }
            else if(isset($_GET['view_customers'])){
                include ('view_customers.php');
            }
            else if(isset($_GET['del_customer'])){
                include ('del_customer.php');
            }
            ?>
        </div>
    </div>
</div>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

    });
</script>
</body>
</html>
