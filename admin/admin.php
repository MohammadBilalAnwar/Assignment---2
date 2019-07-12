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
    <link rel="icon" href="">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bangers|Old+Standard+TT">
    <title>TechBox Admin Panel</title>
    <style>
        * {
            font-family: 'Old Standard TT', serif;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="admin.php?insert_package">
                    <i class="fas fa-plus"></i> Add a new Package
                </a>
            </li>

            <li>
                <a href="admin.php?view_package">
                    <i class="fas fa-plus"></i> View All Packages
                </a>
            </li>

            <li>
                <a href="admin.php?insert_vehicle">
                    <i class="fas fa-plus"></i> Insert A Vehicle
                </a>
            </li>
            <li>
                <a href="admin.php?insert_hotel">
                    <i class="fas fa-plus"></i> Insert A Hotel
                </a>
            </li>
            <li>
                <a href="admin.php?view_vehicle">
                    <i class="fas fa-sitemap"></i> View All Vehicles
                </a>
            </li>
            <li>
                <a href="admin.php?view_hotel">
                    <i class="fas fa-plus"></i> View All Hotels
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

        </nav>
        <div class="container">
            <h2 class="text-center text-primary"><?php echo @$_GET['logged_in']?></h2>
            <?php
            if(isset($_GET['insert_vehicle'])){
                include ('insert_vehicle.php');
            }
            else if(isset($_GET['insert_hotel'])){
                include ('insert_hotel.php');
            }
            else if(isset($_GET['view_vehicle'])){
                include('view_vehicle.php');
            }
            else if(isset($_GET['view_hotel'])){
                include ('view_hotel.php');
            }
            else if(isset($_GET['delete_vehicle'])){
                include('delete_vehicle.php');
            }
            else if(isset($_GET['delete_package'])){
                include('delete_package.php');
            }
            else if(isset($_GET['view_package'])){
                include('view_package.php');
            }
            else if(isset($_GET['insert_package'])){
                include('insert_package.php');
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