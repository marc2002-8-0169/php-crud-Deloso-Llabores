<?php
include_once "db.php";
if(isset($_POST['submit'])){
    $task_name = $_POST['task_name'];
    $task_description = $_POST['descrip'];
    $task_duedate = $_POST['duedate'];
    $task_status = $_POST['tstatus'];

    $query = mysqli_query($conn,"INSERT INTO tasks(task_name,task_description,task_due_date,task_status)VALUES('$task_name','$task_description','$task_duedate','$task_status')");

    if($query){
        echo "<script>alert('New record added!');</script>";
        echo "<script>document.location='appdev.php';</script>";
    }else{
        echo "Error adding data";
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
    <title>TASK MAKER</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <div class="container" style="width:50%">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Task</h2>
            </div>
        </div>
        <form method="POST">
            <div class="row">
            <div class="col-md-6">
                    <label>task_name</label>
                    <input type="text" name="task_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>task_status</label>
                    <input type="text" name="tstatus" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>task_due_date</label>
                    <input type="date" name="duedate" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>task_description</label>
                    <input type="text" name="descrip" class="form-control" required>
                </div>
            </div>
            <div class="row" style="margin-top:1%">
                <div class="col-md-12">
                    <button type="text" name="submit" class="btn btn-primary">Submit</button>
                    <a href="appdev.php" class="btn btn-success">Go to Table</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>