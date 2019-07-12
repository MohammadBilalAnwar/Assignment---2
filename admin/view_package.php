
<div class="row">
    <div class="col-sm-12">
        <h1>Hotels</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Hotel Name</th>
                <th scope="col">Vehicle Name</th>
                <th scope="col">Charges</th>
                <th scope="col">Number Of Days</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $forGoto = 0;
            $get_package = "select * from package";
            $run_package = mysqli_query($con,$get_package);
            $count_package = mysqli_num_rows($run_package);
            $dummy = 0;

            if($count_package==0){
                echo "<h2> No package found in selected criteria </h2>";
            }
            else {
                $i = 0;
                while ($row_package = mysqli_fetch_array($run_package)) {
                    $get_vehicle = "select * from vehicle";
                    $run_vehicle = mysqli_query($con,$get_vehicle);
                    $count_vehicle = mysqli_num_rows($run_vehicle);

                    $get_hotel = "select * from hotel";
                    $run_hotel = mysqli_query($con,$get_hotel);
                    $count_hotel = mysqli_num_rows($run_hotel);

                    $dummy = 0;
                    $p_id = $row_package['p_id'];
                    $p_vehicle_id = $row_package['p_vehicle_id'];
                    $p_hotel_id = $row_package['p_hotel_id'];
                    $p_numOfDays = $row_package['p_numOfDays'];
                    $p_cost = $row_package['p_cost'];
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <?php
                        while($dummy != 1){

                            $row_hotel = mysqli_fetch_array($run_hotel);
                            $h_id = $row_hotel['h_id'];
                            $h_name = $row_hotel['h_name'];
                            if ($h_id == $p_hotel_id){
                                $dummy = 1;
                            }
                        }

                        $dummy = 0;
                        ?>
                        <td><?php echo $h_name; ?></td>
                        <?php
                        while($dummy != 1){
                            $row_vehicle = mysqli_fetch_array($run_vehicle);
                            $v_id = $row_vehicle['v_id'];
                            $v_name = $row_vehicle['v_name'];
                            if ($v_id == $p_vehicle_id){
                                $dummy = 1;
                            }
                        }
                        $dummy = 0;
                        ?>
                        <td><?php echo $v_name; ?></td>
                        <td><?php echo $p_cost;?>/-</td>
                        <td><?php echo $p_numOfDays;?>/-</td>
                        <td>

                            <a href="admin.php?delete_package=<?php echo $p_id?>" class="btn btn-danger">
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