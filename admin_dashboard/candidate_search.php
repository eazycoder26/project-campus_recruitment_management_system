<?php
require('config.php');
// require_once('s_checksession.php');
?>





<?php
//check search or not
if (isset($_POST['input'])) {
    $input = $_POST['input'];

    //database query for search
    $query = "SELECT s.*,  d.dept_type
    FROM candidate_registration s
    INNER JOIN department d ON s.dept_id = d.dept_id
    WHERE
        d.dept_type LIKE '{$input}%' ;
    
    ";


    $result = mysqli_query($con, $query) or die(mysqli_errno($con));

    if (mysqli_num_rows($result) > 0) {
?>
        <table id="dataTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Language</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Depertment Name</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($rec = mysqli_fetch_assoc($result)) {
                   
                ?>
                    <tr>
                        <td><?php echo $rec['name'] ?></td>
                       
                        <td><?php echo $rec['gender'] ?></td>
                        <td><?php echo $rec['languages'] ?></td>
                        <td><?php echo $rec['address'] ?></td>
                        <td><?php echo $rec['city'] ?></td>
                        <td><?php echo $rec['dept_type'] ?></td> 

                        <!-- <td>
                            <form name="edit-<?php echo $i ?>" method="post" action="edit_candidate.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $rec['id']; ?>">
                                <button type="submit" class="btn"><i class="far fa-edit text-primary"></i></button>
                                <!-- <a href="edit_candidate.php" -->
                            <!-- </form>
                        </td>
                        <td>
                            <form name="del-<?php echo $i ?>" method="post" action="del_candidate.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $rec['id']; ?>">
                                <button type="submit" class="btn"><i class="far fa-trash-alt text-danger"></i></button>
                            </form>
                        </td> --> 
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>


<?php
    } else {
        echo "<h6 class=' text-danger text-center mt-3'>No data Found</h6>";
    }
}
?>
