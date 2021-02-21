<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>BMRC Meeting</title>
</head>
<body>
    <?php
    include_once 'config.php';
    
    $id = $_GET['single_id'];

    $query = "SELECT * FROM bmrc_schedule WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        while($row = mysqli_fetch_array($query_run))
        {
            // echo "<pre>";
            // print_r($row);
            // exit();
            ?>
<div class="container">
    <div class="jumbotron ">            
        <h2> Meeting Schedule Updating</h2>
        <hr>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
              <div class="modal-body">                                  
                        <div class="form-group">
                            <label for=""> date </label>
                            <input type="hidden" name="hid_id" value="<?php echo $row['id']; ?>">
                            <input type="date" name="form_date" class="form-control" 
                            value="<?php 
                                        echo $row['date']; 
                                    ?>" required>
                        </div>
                        <div class="form-group">
                            <label for=""> Subject </label>
                            <input type="text" name="form_subject" class="form-control" value="<?php echo $row['subject']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for=""> Time </label>
                            <input type="time" name="form_time" class="form-control" value="<?php $r = $row['time'];//print_r($row['time']) ;
                            echo date("H:i:s", strtotime($r)) ?>" required>
                        </div> 
                        <div class="form-group">
                            <label for=""> Place </label>
                            <input type="text" name="form_place" class="form-control" value="<?php echo $row['place'];?>" required>
                        </div>                                  
              </div>
              <div class="modal-footer">
                <a href="index.php"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Back to Home</button></a>
                <button type="submit" name="update" class="btn btn-primary">Save Data</button>
              </div>
            </form>

        <?php
       
        if(isset($_POST['update'])){
            $id = $_POST['hid_id'];
            $date = $_POST['form_date'];
            $subject  = $_POST['form_subject'];
            $time  = $_POST['form_time'];            
            $place  = $_POST['form_place'];

            $query = "UPDATE bmrc_schedule SET `date`='$date', `subject`='$subject', `time`='$time', `place`='$place' WHERE id='$id'  ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)
            {
                    echo "Congrats! Your Data saved!";
			        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';    
                    exit();
            }
            else
            {
                echo '<script> alert("Data Not Updated"); </script>';
            }
        }

        ?>

    </div>
</div>


            <?php
        }
    }
    else
    {
        echo '<script> alert("No Record Found"); </script>';
    }
   
    ?>
</body>
</html>

