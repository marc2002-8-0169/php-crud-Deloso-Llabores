<!--Add button fro adding new tasks-->
<div class="col-md-12">
    <h2>Task List</h2>
</div>
<div class="cont">
	<form>
	<div class="row" style="margin-top:1%">
                <div class="col-md-6">
					<a href="add.php" class="btn btn-success">Add</a>
                </div>
            </div>
	</form>
</div>
<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "app_acts";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Check if the user submitted the new task form
if (isset($_POST['add_task'])) {
	// Get the user inputs from the form
	$task_name = $_POST['task_name'];
	$task_description = $_POST['task_description'];
	$task_due_date = $_POST['task_due_date'];
	$task_status = $_POST['task_status'];
	
	// Prepare the SQL query to insert the new task into the database
	$sql = "INSERT INTO tasks (task_name, task_description, task_due_date, task_status) VALUES ('$task_name', '$task_description', '$task_due_date', '$task_status')";
	
	// Execute the SQL query and check for errors
	if (mysqli_query($conn, $sql)) {
		echo "New task added successfully!";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

// Edit a task
if (isset($_POST["edit_task"])) {
	$id = $_POST["id"];
	$task_name = $_POST["task_name"];
	$task_description = $_POST["task_description"];
	$task_due_date = $_POST["task_due_date"];
	$task_status = $_POST["task_status"];
	
	$sql = "UPDATE tasks SET task_name='$task_name', task_description='$task_description', task_due_date='$task_due_date', task_status='$task_status' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
		echo "Task updated successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

// Delete a task
if (isset($_GET['delid'])) {
	$id = intval($_GET['delid']);
	$sql = mysqli_query($conn, "DELETE FROM tasks WHERE id='$id'");
	echo "<script>alert('Data deleted...');</script>";
	echo "<script>window.location='task.php';</script>";
}


// Get all tasks from the "tasks" table
$sql = "SELECT id, task_name, task_description, task_due_date, task_status FROM tasks";
$result = $conn->query($sql);
?>

 <!--Display tasks in table-->
<!DOCTYPE html>
<html>
<head>
	<title>Task Maker</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<script>
		$(document).ready(function(){
			$("#find").on("keyup",function(){
				var value=$(this).val().toLowerCase();
				$("#table tr").filter(function(){
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});
	</script>
	<!--// Output data of each row-->
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border: 1px solid black;
		}
		.cont {
			float: right;
		}
		.edit {
			float: right;
		}
		.delete {
			display: inline-block;
		}
	</style>
</head>
<body>
    
	<div class="form-group">
		<input type="text" id="find" placeholder="Find..." class="form-control">
	</div>
	<table>
		<thead>
			<tr><th>id</th><th>task_name</th><th>task_description</th><th>task_due_date</th><th>task_status</th><th>Action</th></tr>
		</thead>
		<tbody id="table">
			<?php if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["task_name"]; ?></td>
						<td><?php echo $row["task_description"]; ?></td>
						<td><?php echo $row["task_due_date"]; ?></td>
						<td><?php echo $row["task_status"]; ?></td>
						<td>
							<!-- Delete task button -->
							<a href="task.php?delid=<?php echo htmlentities($row['id']);?>" onClick ="return confirm('Delete the selection?');" class="btn btn-danger btn-sm">Delete</a>
							<!-- Edit task button -->
							<a href="edit.php?editid=<?php echo htmlentities($row['id']);?>" onClick ="return confirm('Edit the selection?');" class="btn btn-warning btn-sm">Edit</a>
						</td>
					</tr>
				<?php } } else {
					echo "0 results";
				} ?>
				
			</tbody>
		</table>
	</body>
<?php

$conn->close();
?>
</html>