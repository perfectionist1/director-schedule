<?php
    include('session.php');
    include('config/db_config.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <title>My Schedule</title>
</head>
<body>
    <!-- Modal Data input -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Please provide details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form action="savecode.php" method="GET" >
              <div class="modal-body">              
                        <div class="form-group">
                            <label for=""> date </label>
                            <input type="date" name="form_date" class="form-control" placeholder="Enter Date" required>
                            <input type="hidden" name="testing_key" value="Testing Value" />
                        </div>
                        <div class="form-group">
                            <label for=""> Subject </label>
                            <input type="text" name="form_subject" class="form-control" placeholder="Enter Subject" required>
                        </div>
                        <div class="form-group">
                            <label for=""> Time </label>
                            <input type="time" name="form_time" class="form-control" placeholder="Enter Time" required>
                        </div> 
                        <div class="form-group">
                            <label for=""> Place </label>
                            <input type="text" name="form_place" class="form-control" placeholder="Enter Place" required>
                        </div>                                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="insertdt" class="btn btn-primary">Save Data</button>
              </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Modal for Data input Ends -->

        <!-- Modal for Edit -->        
    <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Please provide details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         
            <form action="updatedata.php" method="POST" >
              <div class="modal-body">                                  
                        <div class="form-group">
                            <label for=""> date </label>
                            <input type="date" name="form_date" class="form-control" value="<?php //echo $row['date']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for=""> Subject </label>
                            <input type="text" name="form_subject" class="form-control" placeholder="Enter Subject" required>
                        </div>
                        <div class="form-group">
                            <label for=""> Time </label>
                            <input type="time" name="form_time" class="form-control" placeholder="Enter Time" required>
                        </div> 
                        <div class="form-group">
                            <label for=""> Place </label>
                            <input type="text" name="form_place" class="form-control" placeholder="Enter Place" required>
                        </div>                                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
              </div>
            </form>
           
        </div>
      </div>
    </div> -->
    <!-- Modal for Edit Ends -->
    <div class="container">
        <div class="jumbotron">
            <div class="card providing-data-heading">
                <strong><h2> সভার সময় সূচী </h2></strong> <a href="logout.php"><button  type="button" class="btn btn-dark schedule-signout">
                        Sign Out
                    </button></a>
            </div>
            <div class="card for-buttons">
                <div class="card-body "> 
                    <a href="previous.php"> <button class="btn btn-secondary pre-schedule"> Previous Schedule </button> </a>
                    <!-- Button trigger modal -->
                    <button  type="button" class="btn btn-primary add-schedule" data-toggle="modal" data-target="#exampleModal">
                        Add Schedule
                    </button>
                </div>
            </div>                           
                <?php
                    

                    $query = "SELECT * FROM bmrc_schedule WHERE date >=CURDATE() ORDER BY date ASC";
                    $query_run = mysqli_query($connection, $query);
                ?>
            <div class="table-responsive"> 
            <table class="table table-bordered table-hover "  style="background-color: white;" id ="tbl">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 2%; text-align: center;" > ID </th>
                        <th style="width: 8%; text-align: center;"> Date </th>
                        <th style="width: 40%; text-align: center;"> Subject</th>
                        <th style="width: 7%; text-align: center;"> Time </th>
                        <th style="width: 25%; text-align: center;"> Place </th>
                        <th style="width: 18%; text-align: center;"> Actions </th>
                    </tr>
                </thead>

                <?php
                    if($query_run){
                        $i = 0;
                        while($row = mysqli_fetch_array($query_run)){                  
                        $i++;
                ?>
                        <tbody class="table-striped">
                           
                            <?php
                                $d = $row['date']; 
                                            $dt = date("d-m-Y, D", strtotime($d));
                                            if($dt == date("d-m-Y, D", strtotime("now"))){
                                                echo "<style> tr{font-weight: bold;} </style>";
                            ?>
                            <tr>
                                <td style="text-align: center;"> <?php echo $i; ?> </td>
                                <td style="text-align: center;"> 
                                    <?php 
                                            // $d = $row['date']; 
                                            // $dt = date("d-m-Y, D", strtotime($d));
                                            // if($dt == date("d-m-Y, D", strtotime("now"))){
                                            //     echo "<strong>". $dt ."</strong>";
                                            // }
                                        echo $dt;
                                            
                                    ?>
                                </td>
                                <td style="text-align: center;"> <?php echo $row['subject']; ?> </td>
                                <td style="text-align: center;"> 
                                    <?php 
                                        $r = $row['time']; 
                                        
                                        $tm = date("h:i A", strtotime($r));
                                        echo $tm;
                                    ?> 
                                </td>
                                <td style="text-align: center;"> <?php echo $row['place'];?></td>
                                <td style="text-align: center;">
                                    <!-- <form action="updatedata.php" method="post">
                                        <input type="hidden" name="single_id" value="<?php //echo $row['id'] ?>">
                                        <input type="submit" name="edit" class="btn btn-success" value="EDIT">
                                    </form> -->
                                    <a class="btn btn-success" href="updatedata.php?single_id=<?php echo $row['id']; ?>"> EDIT</a>  |
                                    
                                    <a class="btn btn-danger" href="delete.php?single_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure, you want to delete it?')"> Delete</a> 
                                    <!-- <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php //echo $row['id'] ?>">
                                        <input type="submit" name="delete" class="btn btn-danger" value="DELETE">
                                    </form> -->
                                </td>
                            <?php
                                }else{

                            ?>

                            <tr>
                                <td style="text-align: center;"> <?php echo $i; ?> </td>
                                <td style="text-align: center;"> 
                                    <?php 
                                            // $d = $row['date']; 
                                            // $dt = date("d-m-Y, D", strtotime($d));
                                            // if($dt == date("d-m-Y, D", strtotime("now"))){
                                            //     echo "<strong>". $dt ."</strong>";
                                            // }
                                        echo $dt;
                                            
                                    ?>
                                </td>
                                <td style="text-align: center;"> <?php echo $row['subject']; ?> </td>
                                <td style="text-align: center;"> 
                                    <?php 
                                        $r = $row['time']; 
                                        
                                        $tm = date("h:i A", strtotime($r));
                                        echo $tm;
                                    ?> 
                                </td>
                                <td style="text-align: center;"> <?php echo $row['place'];?></td>
                                <td style="text-align: center;">
                                    <!-- <form action="updatedata.php" method="post">
                                        <input type="hidden" name="single_id" value="<?php //echo $row['id'] ?>">
                                        <input type="submit" name="edit" class="btn btn-success" value="EDIT">
                                    </form> -->
                                    <a class="btn btn-success" href="updatedata.php?single_id=<?php echo $row['id']; ?>"> EDIT</a>  |
                                    <a class="btn btn-danger" href="delete.php?single_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure, you want to delete it?')"> Delete</a> 
                                    <!-- <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php //echo $row['id'] ?>">
                                        <input type="submit" name="delete" class="btn btn-danger" value="DELETE">
                                    </form> -->
                                </td>
                            <?php
                                }
                            ?>

                            </tr>
                        </tbody>
                      <?php
                              }
                        }else{
                            echo "No record found";
                        }
                      ?>
            </table>
            </div>
        </div>
    </div>
    <?php
        include_once 'footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

