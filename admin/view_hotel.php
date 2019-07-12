<div class="row">
    <div class="col-sm-12">
        <h1>Hotels</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Location</th>
                <th scope="col">Hotel Picture</th>
                <th scope="col">Charges</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $get_hotel = "select * from hotel";
            $run_hotel = mysqli_query($con,$get_hotel);
            $count_hotel = mysqli_num_rows($run_hotel);
            if($count_hotel==0){
                echo "<h2> No hotel found in selected criteria </h2>";
            }
            else {
                $i = 0;
                while ($row_hotel = mysqli_fetch_array($run_hotel)) {
                    $h_id = $row_hotel['h_id'];
                    $h_loc = $row_hotel['h_loc'];
                    $h_charges = $row_hotel['h_charges'];
                    $h_pic = $row_hotel['h_pic'];
                    $h_description = $row_hotel['h_description'];
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <td><?php echo $h_loc; ?></td>
                        <td><img class="img-thumbnail" src='product_images/<?php echo $h_pic;?>' width='80' height='80'></td>
                        <td><?php echo $h_charges; ?>/-</td>
                        <td><?php echo $h_description;?></td>
                        <td>

                            <a href="admin.php?delete_hotel=<?php echo $h_id?>" class="btn btn-danger">
                                <i class="fa fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>