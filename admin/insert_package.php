<?php
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}

if (isset($_POST['insert_package'])) {
    //getting text data from the fields
    $p_vehicle_id = test_input($_POST['p_vehicle_id']);
    $p_hotel_id = test_input($_POST['p_hotel_id']);
    $p_numOfDays = test_input($_POST['p_numOfDays']);
    $p_cost = test_input($_POST['p_cost']);

    if (!preg_match("^(0+[1-9]|[1-9])[0-9]*$^", $p_vehicle_id)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Vehicle id."
        );
    }  else if (!preg_match("^(0+[1-9]|[1-9])[0-9]*$^", $p_hotel_id)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid hotel id."
        );
    }  else if (!preg_match("/[1-9]|[1-2][0-9]/", $p_numOfDays)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid number of days."
        );
    } else {
                $insert_product = "insert into package (p_id, p_vehicle_id,p_hotel_id,p_numOfDays,p_cost) 
                  VALUES ('$p_vehicle_id','$p_hotel_id','$p_numOfDays','$p_cost');";
                $insert_package = mysqli_query($con, $insert_product);
                if ($insert_package) {
                    //header("location: ".$_SERVER['PHP_SELF']);
                    $response = array(
                        "type" => "success",
                        "message" => "Product uploaded successfully."
                    );
                }
                else{
                    $response = array(
                        "type" => "warning",
                         "message" => "Problem in uploading image files."
                    );
                }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<h1 class="text-center my-4"><i class="fas fa-plus fa-md"></i> <span class="d-none d-sm-inline"> Add New </span>
    Package </h1>
<?php if (!empty($response)) { ?>
    <div class="alert alert-<?php echo $response["type"]; ?>">
        <?php echo $response["message"]; ?>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="p_numOfDays" class="float-md-right"> <span class="d-sm-none d-md-inline"> Number </span>
                Of Days:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="p_numOfDays" name="p_numOfDays"
                       placeholder="Enter Number of Days in Package"
                    <?php
                    if (@$response["type"] == "warning") {
                        echo "value='$p_numOfDays'";
                    }
                    ?>
                >
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="p_hotel_id " class="float-md-right"><span class="d-sm-none d-md-inline"> Hotel </span>
                :</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
                </div>
                <select class="form-control" id="p_hotel_id" name="p_hotel_id">
                    <option>Select Hotel</option>

                    <?php
                    $getHotelQuery = "select * from hotel";
                    $getHotelResult = mysqli_query($con, $getHotelQuery);
                    while ($row = mysqli_fetch_assoc($getHotelResult)) {
                        $h_id = $row['h_id'];
                        $h_name = $row['h_name'];
                        if (@$response["type"] == "warning" && $h_id == $p_hotel_id ) {
                            echo "<option value='$h_id' selected>$h_name</option>";
                        } else {
                            echo "<option value='$h_id'>$h_name</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="pro_brand" class="float-md-right"> <span class="d-sm-none d-md-inline"> Select </span>
                Car:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-stamp"></i></div>
                </div>
                <select class="form-control" id="p_vehicle_id" name="p_vehicle_id">
                    <option>Select Vehicle</option>
                    <?php
                    $getVehicleQuery = "select * from vehicle";
                    $getVehicleResult = mysqli_query($con, $getVehicleQuery);
                    while ($row = mysqli_fetch_assoc($getVehicleResult)) {
                        $v_id = $row['$v_id'];
                        $v_name = $row['v_name'];

                        if ($response["type"] == "warning" && $v_id == $p_vehicle_id) {
                            echo "<option value='$v_id' selected>$v_name</option>";
                        } else {
                            echo "<option value='$v_id'>$v_name</option>";
                        }

                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="p_cost" class="float-md-right"> <span class="d-sm-none d-md-inline"> Package </span>
                Price:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-money-bill"></i></div>
                </div>
                <input class="form-control" id="p_cost" name="p_cost" placeholder="Enter Package Cost"
                    <?php
                    if (@$response["type"] == "warning") {
                        echo "value='$p_cost'";
                    }
                    ?>
                >
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto"></div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <button type="submit" name="insert_package" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>
                Insert Now
            </button>
        </div>
    </div>
</form>