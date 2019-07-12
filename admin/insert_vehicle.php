<?php
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}

if (isset($_POST['insert_vehicle'])) {
    //getting text data from the fields
    $v_type = test_input($_POST['v_type']);
    $v_name = test_input($_POST['v_name']);
    $v_class = test_input($_POST['v_class']);
    $num_of_passen = test_input($_POST['num_of_passen']);
    $rent = test_input($_POST['rent']);
    //getting image from the field
    $v_pic_name = $_FILES['v_pic']['name'];
    $v_pic_tmp = $_FILES['v_pic']['tmp_name'];
    $v_pic_size = $_FILES['v_pic']['size'];

    if (!preg_match("/[a-zA-Z ]+/", $v_type) || strlen($v_type) < 2) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Vehicle Type."
        );
    } else if (!preg_match("/[a-zA-Z ]+/", $v_class) || strlen($v_class) < 2) {
        $response = array(
        "type" => "warning",
        "message" => "Enter Valid Vehicle Class."
      );
    } else if (!preg_match("/[a-zA-Z ]+/", $v_name) || strlen($v_name) < 2) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Vehicle Name."
        );
    }else if (!preg_match("/[1-9]|[1][0-7]/", $num_of_passen)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Number of Passengers."
        );
    }else if (!preg_match("^(0+[1-9]|[1-9])[0-9]*$^", $rent)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Rent."
        );
    }  else if (file_exists($v_pic_tmp)) {

        $image_info = getimagesize($v_pic_tmp);
        $width = $image_info[0];
        $height = $image_info[1];
        $target_directory = "product_images/";
        $allowed_image_extension = array("png", "jpg", "jpeg");

        // Get image file extension
        $image_extension = pathinfo($v_pic_name, PATHINFO_EXTENSION);

        // Validate file input to check if is not empty
        // Validate file input to check if is with valid extension
        if (!in_array($image_extension, $allowed_image_extension)) {
            $response = array(
                "type" => "warning",
                "message" => "Upload valid images. Only PNG and JPEG are allowed."
            );
            //echo $result;
        }    // Validate image file size
        else if ($v_pic_size > 2000000) {
            $response = array(
                "type" => "warning",
                "message" => "Image size exceeds 2MB"
            );
        }    // Validate image file dimension
        else if ($width > "2000" || $height > "1000") {
            $response = array(
                "type" => "warning",
                "message" => "Image dimension should be within 1000X800"
            );
        } else {
            $updated_img_name = "user_" . time() . "_" . $v_pic_name;
            $target = $target_directory . $updated_img_name;
            if (move_uploaded_file($v_pic_tmp, $target)) {

                $insert_vehicle = "insert into vehicle (v_name,v_type,v_class,num_of_passen,rent,v_pic)
                  VALUES ('$v_name','$v_type','$v_class','$num_of_passen','$rent','$updated_img_name');";
                $insert_Avehicle = mysqli_query($con, $insert_vehicle);
                if ($insert_Avehicle) {
                    header("location: ".$_SERVER['PHP_SELF']);
                    $response = array(
                        "type" => "success",
                        "message" => "Product uploaded successfully."
                    );
                }


            } else {
                $response = array(
                    "type" => "warning",
                    "message" => "Problem in uploading image files."
                );
            }
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
    Vehicle </h1>
<?php if (!empty($response)) { ?>
    <div class="alert alert-<?php echo $response["type"]; ?>">
        <?php echo $response["message"]; ?>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="v_type" class="float-md-right"> <span class="d-sm-none d-md-inline"> Vehicle </span>
                Type:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="v_type" name="v_type"
                       placeholder="Enter Vehicle Type"
                    <?php
                    if (@$response["type"] == "warning") {  // @before response
                        echo "value='$v_type'";
                    }
                    ?>
                >
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="v_name" class="float-md-right"> <span class="d-sm-none d-md-inline"> Vehicle </span>
                Name:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="v_name" name="v_name"
                       placeholder="Enter Vehicle Type"
                    <?php
                    if (@$response["type"] == "warning") {  // @before response
                        echo "value='$v_name'";
                    }
                    ?>
                >
            </div>
        </div>
    </div>
    <div class="row my-3">
    </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="v_class" class="float-md-right"> <span class="d-sm-none d-md-inline"> Vehicle </span>
                Class:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-stamp"></i></div>
                </div>
                <input type="text" class="form-control" id="v_class" name="v_class"
                       placeholder="Enter Vehicle Class"
                    <?php
                    if (@$response["type"] == "warning") {  // @before response
                        echo "value='$v_class'";
                    }
                    ?>
                >
            </div>
        </div>
    <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
        <label for="num_of_passen" class="float-md-right"> <span class="d-sm-none d-md-inline"> Number </span>
            Of Passengers:</label>
    </div>
    <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
            </div>
            <input type="text" class="form-control" id="num_of_passen" name="num_of_passen"
                   placeholder="Enter Number of Passengers"
                <?php
                if (@$response["type"] == "warning") {  // @before response
                    echo "value='$num_of_passen'";
                }
                ?>
            >
        </div>
    </div>
    <div class="row my-3">
    <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
        <label for="v_pic" class="float-md-right"><span class="d-sm-none d-md-inline"> Vehicle </span>
            Image:</label>
    </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-image"></i></div>
            </div>
            <input class="form-control" type="file" id="v_pic" name="v_pic">
        </div>
    </div>

        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="rent" class="float-md-right"> <span class="d-sm-none d-md-inline"> Rent </span>
                :</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="rent" name="rent"
                       placeholder="Enter The Rent"
                    <?php
                    if (@$response["type"] == "warning") { // @before response
                        echo "value='$rent'";
                    }
                    ?>
                >
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto"></div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <button type="submit" name="insert_vehicle" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>
                Insert Now
            </button>
        </div>
    </div>
</form>
