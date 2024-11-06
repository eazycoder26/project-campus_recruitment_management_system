<?php 
    require('config.php');
    
    $id=$_POST['id'];
    $del=mysqli_query($con, "DELETE FROM candidate_registration WHERE id=$id")or die(mysqli_error($con));
    if($del==1){
        ?>
        <script>
            window.location='candidate_view.php';
        </script>
        <?php
    }else{
       
        header('location:candidate_view.php');
    }
?>