<?php
if(!isset($_SESSION['user_email'])){
    header('location: admin_login.php?not_admin=You are not Admin!');
}

if (isset($_POST['insert_hotel'])) {
    //getting text data from the fields
    $h_loc = test_input($_POST['h_loc']);
    $h_charges = test_input($_POST['h_charges']);
    $h_description = test_input($_POST['h_description']);
    $h_name = test_input($_POST['h_name']);
    //getting image from the field
    $h_pic_name = $_FILES['h_pic']['name'];
    $h_pic_tmp = $_FILES['h_pic']['tmp_name'];
    $h_pic_size = $_FILES['h_pic']['size'];

    if (!preg_match("/[a-zA-Z ]+/", $h_loc) || strlen($h_loc) < 2) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Location."
        );
    }  else if (!preg_match("/[a-zA-Z1-9 ]+/", $h_description)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid description."
        );
    }else if (!preg_match("/[a-zA-Z ]+/", $h_name)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid description."
        );
    }else if (!preg_match("^(0+[1-9]|[1-9])[0-9]*$^", $h_charges)) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Charges."
        );
    }  else if (file_exists($h_pic_tmp)) {

        $image_info = getimagesize($h_pic_tmp);
        $width = $image_info[0];
        $height = $image_info[1];
        $target_directory = "product_images/";
        $allowed_image_extension = array("png", "jpg", "jpeg");

        // Get image file extension
        $image_extension = pathinfo($h_pic_name, PATHINFO_EXTENSION);

        // Validate file input to check if is not empty
        // Validate file input to check if is with valid extension
        if (!in_array($image_extension, $allowed_image_extension)) {
            $response = array(
                "type" => "warning",
                "message" => "Upload valid images. Only PNG and JPEG are allowed."
            );
            //echo $result;
        }    // Validate image file size
        else if ($h_pic_size > 2000000) {
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
            $updated_img_name = "user_" . time() . "_" . $h_pic_name;
            $target = $target_directory . $updated_img_name;
            if (move_uploaded_file($h_pic_tmp, $target)) {

                $insert_hotel = "insert into hotel (h_name,h_loc,h_charges,h_pic,h_descripton)
                  VALUES ('h_name','$h_loc','$h_charges','$updated_img_name','h_descripton');";
                $insert_Ahotel = mysqli_query($con, $insert_hotel);
                if ($insert_Ahotel) {
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
    Hotel </h1>
<?php if (!empty($response)) { ?>
    <div class="alert alert-<?php echo $response["type"]; ?>">
        <?php echo $response["message"]; ?>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="h_loc" class="float-md-right"> <span class="d-sm-none d-md-inline"> Hotel </span>
                Location:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="h_loc" name="h_loc"
                       placeholder="Enter Hotel Location"
                    <?php
                    if (@$response["type"] == "warning") {  // @before response
                        echo "value='h_loc'";
                    }
                    ?>
                >
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="h_charges" class="float-md-right"> <span class="d-sm-none d-md-inline"> Hotel </span>
                Charges:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="h_charges" name="h_charges"
                       placeholder="Enter Hotel Charges"
                    <?php
                    if (@$response["type"] == "warning") {  // @before response
                        echo "value='h_charges'";
                    }
                    ?>
                >
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="h_description" class="float-md-right"><span class="d-sm-none d-md-inline"> Hotel </span>
                Description:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-comment-alt"></i></div>
                </div>
                <textarea class="form-control" type="file" id="h_description" name="h_description"
                          placeholder="Enter Hotel Description"></textarea>
            </div>
        </div>
    <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
        <label for="v_pic" class="float-md-right"><span class="d-sm-none d-md-inline"> Hotel </span>
            Image:</label>
    </div>
    <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-image"></i></div>
            </div>
            <input class="form-control" type="file" id="h_pic" name="h_pic">
        </div>
    </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="h_loc" class="float-md-right"> <span class="d-sm-none d-md-inline"> Hotel </span>
                Name:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
                </div>
                <input type="text" class="form-control" id="h_name" name="h_name"
                       placeholder="Enter Hotel name"
                    <?php
                    if (@$response["type"] == "warning") {  // @before response
                        echo "value='h_name'";
                    }
                    ?>
                >
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto"></div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <button type="submit" name="insert_hotel" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>
                Insert Now
            </button>
        </div>
    </div>
</form>
