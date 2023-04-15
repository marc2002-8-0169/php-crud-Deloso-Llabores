<?php
include_once "db.php";

if(isset($_POST['update'])){
    $edit = $_GET['editid'];
    $task_name = $_POST['task_name'];
    $task_status = $_POST['task_status'];
    $task_due_date = $_POST['task_due_date'];
    $task_description = $_POST['task_description'];
    $msql = mysqli_query($conn,"UPDATE tasks SET task_name='$task_name', task_description='$task_description', task_due_date='$task_due_date', task_status='$task_status' where id='$edit'");
    if($msql){
        echo "<script>alert('Task is edited!!');</script>";
        echo "<script>document.location='task.php';</script>";
    }else{
        echo "There was an error in editing!";
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
    <title>Task Maker</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <div class="container" style="width:50%">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Task</h2>
            </div>
        </div>
        <form method="POST">
            <?php
                $edit = $_GET['editid'];
                $mysql = mysqli_query($conn,"SELECT * FROM tasks where id='$edit'");
                while($row=mysqli_fetch_array($mysql)){
            ?>
            <div class="row">
            <div class="col-md-6">
                    <label>task_name</label>
                    <input type="text" name="task_name" value="<?php echo $row['task_name']?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>task_status</label>
                    <input type="text" name="task_status" value="<?php echo $row['task_status']?>" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>task_due_date</label>
                    <input type="date" name="task_due_date" value="<?php echo $row['task_due_date']?>" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>task_description</label>
                    <input type="text" name="task_description" value="<?php echo $row['task_description']?>" class="form-control" required>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="row" style="margin-top:1%">
                <div class="col-md-12">
                    <button type="text" name="update" class="btn btn-primary">Go</button>
                    <a href="task.php" class="btn btn-success">Go to Table</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>