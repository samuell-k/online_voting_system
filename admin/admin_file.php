<!DOCTYPE html>
<?php 
    session_start(); // Ensure the session is started to use session variables
    require 'validator.php';
    require_once 'conn.php';
?>
<html lang="en">
<head>
    <title>School File Management System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <style>
        /* Flexbox for aligning buttons */
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <label class="navbar-brand">School File Management System</label>
            <?php 
                $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error($conn));
                $fetch = mysqli_fetch_array($query);
            ?>
            <ul class="nav navbar-right">    
                <li class="dropdown">
                    <a class="user dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php echo $fetch['firstname']." ".$fetch['lastname']; ?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <?php include 'sidebar.php'; ?>
    <div id="content">
        <br /><br /><br />
        
        <!-- Section for Storage Records -->
        <div class="alert alert-info"><h3>Storage Records</h3></div>
        <br /><br />
        <table id="table_storage" class="table table-bordered">
            <thead>
                <tr>
                    <th>Store ID</th>
                    <th>Filename</th>
                    <th>File Type</th>
                    <th>Date Uploaded</th>
                    <th>Student No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch records from the storage table
                    $queryStorage = "SELECT store_id, filename, file_type, date_uploaded, stud_no FROM `storage`";
                    $resultStorage = mysqli_query($conn, $queryStorage) or die(mysqli_error($conn));

                    while ($fetchStorage = mysqli_fetch_array($resultStorage)) {
                ?>
                    <tr class="del_record<?php echo $fetchStorage['stud_no']; ?>">
                        <td><?php echo $fetchStorage['store_id']; ?></td>
                        <td><?php echo $fetchStorage['filename']; ?></td>
                        <td><?php echo $fetchStorage['file_type']; ?></td>
                        <td><?php echo $fetchStorage['date_uploaded']; ?></td>
                        <td><?php echo $fetchStorage['stud_no']; ?></td>
                        <td>
                            <div class="button-group">
                                <a href="download.php?store_id=<?php echo $fetchStorage['store_id']; ?>" class="btn btn-success">
                                    <span class="glyphicon glyphicon-download"></span> Download
                                </a>
                                <button class="btn btn-danger btn_remove" type="button" id="<?php echo $fetchStorage['stud_no']; ?>" >
                                    <span class="glyphicon glyphicon-trash"></span> Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <!-- Section for Storage2 Records -->
        <div class="alert alert-info"><h3>Storage2 Records</h3></div>
        <button class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add Record</button>
        <br /><br />
        <table id="table_storage2" class="table table-bordered">
            <thead>
                <tr>
                    <th>Store ID</th>
                    <th>Filename</th>
                    <th>File Type</th>
                    <th>Date Uploaded</th>
                    <th>Student No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Fetch records from the storage2 table
                    $queryStorage2 = "SELECT store_id, filename, file_type, date_uploaded, stud_no FROM `storage2`";
                    $resultStorage2 = mysqli_query($conn, $queryStorage2) or die(mysqli_error($conn));

                    while ($fetchStorage2 = mysqli_fetch_array($resultStorage2)) {
                ?>
                    <tr class="del_record<?php echo $fetchStorage2['store_id']; ?>">
                        <td><?php echo $fetchStorage2['store_id']; ?></td>
                        <td><?php echo $fetchStorage2['filename']; ?></td>
                        <td><?php echo $fetchStorage2['file_type']; ?></td>
                        <td><?php echo $fetchStorage2['date_uploaded']; ?></td>
                        <td><?php echo $fetchStorage2['stud_no']; ?></td>
                        <td>
                            <div class="button-group">
                                <a href="download.php?store_id=<?php echo $fetchStorage2['store_id']; ?>" class="btn btn-success">
                                    <span class="glyphicon glyphicon-download"></span> Download
                                </a>
                                <button class="btn btn-danger btn_remove" type="button" id="<?php echo $fetchStorage2['store_id']; ?>">
                                    <span class="glyphicon glyphicon-trash"></span> Remove
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="footer">
        <label class="footer-title">&copy; Copyright School File Management System <?php echo date("Y", strtotime("+8 HOURS")); ?></label>
    </div>
    <?php include 'script.php'; ?>
    
    <!-- Modal for confirmation -->
    <div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Confirm Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to proceed?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btn_yes">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Record -->
    <div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Add Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="add_record.php">
                        <input type="file" name="file" size="4" style="background-color:#fff;" required="required" />
                        <br />
                        <input type="hidden" name="stud_no" value="11"/>
                        <button class="btn btn-success btn-sm" name="submit"><span></span> Add File</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        // Delete action
        $('.btn_remove').on('click', function(){
            var store_id = $(this).attr('id');
            $("#modal_confirm").modal('show');
            $('#btn_yes').attr('data-action', 'remove').attr('name', store_id);
        });

        $('#btn_yes').on('click', function(){
            var id = $(this).attr('name');
            var action = $(this).attr('data-action');
            if (action == 'remove') {
                $.ajax({
                    url: 'remove_file.php',
                    type: 'POST',
                    data: {store_id: id},
                    success: function(response){
                        if(response == 1){
                            $('.del_record' + id).fadeOut();
                        }else{
                           window.location.reload()
                        }
                        $("#modal_confirm").modal('hide');
                    }
                });
            }
        });

		


    });


	$(document).ready(function(){


 // Delete action
 $('.btn_remove').on('click', function(){
            var stud_no = $(this).attr('id');
            $("#modal_confirm").modal('show');
            $('#btn_yes').attr('data-action', 'remove').attr('name', stud_no);
        });

		
        $('#btn_yes').on('click', function(){
            var idd = $(this).attr('name');
            var action = $(this).attr('data-action');
            if (action == 'remove') {
                $.ajax({
                    url: 'remove_file1.php',
                    type: 'POST',
                    data: {stud_no: id},
                    success: function(response){
                        if(response == 1){
                            $('.del_record' + idd).fadeOut();
                        }else{
                           window.location.reload()
                        }
                        $("#modal_confirm").modal('hide');
                    }
                });
            }
        });




	});

    </script>
</body>
</html>
