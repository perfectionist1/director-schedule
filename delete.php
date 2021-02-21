<?php

    include_once 'config/db_config.php';

if(isset($_GET['single_id']))
{
    $id =$_GET['single_id'];

    $query = "DELETE FROM bmrc_schedule WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        
        header("location:index.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>

