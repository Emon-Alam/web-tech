<?php
session_start();
$userName=$_SESSION['userName'];
if(!isset($_SESSION['userName']))
{
	header("Location:login.php");
}
?>

<html>
	<head>
		<title>Update</title>
		<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" type="text/css" href="CSS/pass.css">
	</head>
	<body>
		<div class="grid-container">
  <div class="header">
    <h2 style="color: #2E4053"; align="left">Tailor Management System </h2>

  </div>

  <div class="left" style="background-color:#aaa;">
  <ul>

  <li><a href="nhome.php">Dashboard</a></li>
  <li><a href="view.php?userName=<?php echo $userName; ?>">View Profile</a></li>
  <li><a href="edit.php">Edit Profile</a></li>
  <li><a href="changepic.php">Change Profile Picture</a></li>
  <li><a href="changepass.php">Change Password</a></li>
   <li><a href="all_taken_products.php">Taken Products</a></li>
  <li><a href="all_orders.php">Order Lists</a></li>

  <li><a href="employee_list.php">Employees</a></li>
  <li><a href="delivery.php">Delivery</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
  </div>
  <div class="middle" style="background-color:#bbb;">
		<fieldset align="center">
			<legend>Update</legend>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<table align="center">
					<tr>
						<td>Name</td>
						<td><input type="text" name="name" value="<?php echo $_GET['Name'] ?>"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" value="<?php echo $_GET['Email'] ?>"></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" name="userName" value="<?php echo $_GET['Username'] ?>"></td>
					</tr>
					<tr>

						<td></td>
						<td><input type="submit" name="adduser" value="Edit"/></td>
					</tr>
				</table>
			</form>
		</fieldset>
	</div>
	</body>
	</html>

<?php
if (isset($_POST['adduser']))
{
	$con=mysqli_connect("localhost","root","","db");
	if(!$con)
	{
		die("Connection Error: ".mysqli_connect_error()."<br/>");
	}
	if (isset($userName))
	{
		$id=$_GET['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$userName=$_POST['userName'];
		$sql="UPDATE user SET name='$name',email='$email',userName='$userName' WHERE id='$id'";
		if(mysqli_query($con,$sql))
		{
			header("Location:nhome.php");
		}
		else
		{
			echo "Error in updating: ".mysqli_error($con);
		}
		mysqli_close($con);
	}
}
?>
