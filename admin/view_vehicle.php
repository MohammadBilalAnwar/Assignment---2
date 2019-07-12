<div class="row">
    <div class="col-sm-12">
        <h1>Vehicles</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Picture</th>
                <th scope="col">Class</th>
                <th scope="col">Rent</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $get_vehicle = "select * from vehicle";
            $run_vehicle = mysqli_query($con,$get_vehicle);
            $count_vehicle = mysqli_num_rows($run_vehicle);
            if($count_vehicle==0){
                echo "<h2> No package found in selected criteria </h2>";
            }
            else {
                $i = 0;
                while ($row_vehicle = mysqli_fetch_array($run_vehicle)) {
                    $v_id = $row_vehicle['v_id'];
                    $v_type = $row_vehicle['v_type'];
                    $v_class = $row_vehicle['v_class'];
                    $rent = $row_vehicle['rent'];
                    $v_pic = $row_vehicle['v_pic'];
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <td><?php echo $v_type; ?></td>
                        <td><img class="img-thumbnail" src='product_images/<?php echo $v_pic;?>' width='80' height='80'></td>
                        <td><?php echo $v_class; ?> </td>
                        <td><?php echo $rent; ?>/-</td>
                        <td>
                            <a href="admin.php?delete_vehicle=<?php echo $v_id?>" class="btn btn-danger">
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