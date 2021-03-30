<?php
session_start();
$userName=$_SESSION['userName'];
$name=$_SESSION['name'];
if(!isset($_SESSION['userName']))
{
  header("Location:login.php");
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="CSS/pass.css">
</head>
<body>


<div class="grid-container">
  <div class="header">
    <h2 style="color: #2E4053"; align="left">Tailor Management System <?php
    $name=$_SESSION['name'];
    ?></h2>

  </div>

  <div class="left" style="background-color:#aaa;">
  <ul>

  <li><a href="nhome.php">Dashboard</a></li>
  <li><a href="view.php?userName=<?php echo $userName; ?>">View Profile</a></li>
  <li><a href="edit.php">Edit Profile</a></li>
  <li><a href="changepic.php">Change Profile Picture</a></li>
  <li><a href="changepass.php">Change Password</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
  </div>
  <div class="middle" style="background-color:#bbb;">
    <?php
    $con=mysqli_connect("localhost","root","","db");
  if(!$con)
  {
    die("Connection Error: ".mysqli_connect_error()."<br/>");
  }
    $sql="SELECT * FROM admin WHERE userName='$userName'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
      ($row=mysqli_fetch_array($result));
  	  {
       $name=$row["name"];
       $email=$row["email"];
       $gender=$row["gender"];
       $dob=$row["dob"];
	  }
    }
    else
    {
      echo "No data found.<br/>";
    }
    ?>
     <fieldset align="center">
			<legend>Edit Profile</legend>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<table align="left">
					<tr>
						<td>Name</td>
						<td><input type="text" name="name" value=<?php echo"$name" ?>></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" value=<?php echo"$email" ?>></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><input type="text" name="gender" value=<?php echo"$gender" ?>></td>
					</tr>
                    <tr>
						<td>Date of Birth</td>
						<td><input type="text" name="dob" value=<?php echo"$dob" ?>></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="change" value="Submit"/></td>
					</tr>
				</table>
			</form>
		</fieldset>
  </div>

  <?php
if (isset($_POST['change']))
{
	$con=mysqli_connect("localhost","root","","db");
	if(!$con)
	{
		die("Connection Error: ".mysqli_connect_error()."<br/>");
	}
	if (isset($userName))
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$sql="UPDATE admin SET name='$name',email='$email',gender='$gender',dob='$dob' WHERE userName='$userName'";
		if(mysqli_query($con,$sql))
		{
			header("Location:view.php");
		}
		else
		{
			echo "Error in updating: ".mysqli_error($con);
		}
		mysqli_close($con);
	}
}
?>

  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
