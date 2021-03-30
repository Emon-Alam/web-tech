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
    <h2 style="color: #2E4053 "; align="left">Tailor Management System <?php
    $name=$_SESSION['name'];
    ?></h2>

  </div>

  <div class="left" style="background-color:#aaa;">
  <ul>

  <li><a href="nuser.php">Dashboard</a></li>
  <li><a href="user_view.php?userName=<?php echo $userName; ?>">View Profile</a></li>
  <li><a href="user_edit.php">Edit Profile</a></li>
  <li><a href="user_changepic.php">Change Profile Picture</a></li>
  <li><a href="user_changepass.php">Change Password</a></li>
  <li><a href="user_placeorder.php">Place order</a></li>

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
    $sql="SELECT * FROM user WHERE userName='$userName'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
      ($row=mysqli_fetch_array($result));
  	  {
       $password=$row["password"];
	  }
    }
    else
    {
      echo "No data found.<br/>";
    }
    ?>
     <fieldset align="center">
			<legend>Change Password</legend>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<table align="left">
					<tr>
						<td>Current Password</td>
						<td><input type="password" name="cpass"></td>
					</tr>
					<tr>
						<td><p style="color: green">New Password</p></td>
						<td><input type="password" name="npass"></td>
					</tr>
					<tr>
						<td><p style="color: red">Retype New Password</p></td>
						<td><input type="password" name="rnpass"></td>
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
    $cpass=$_POST['cpass'];
    $npass=$_POST['npass'];
    $rnpass=$_POST['rnpass'];
    if($password==$cpass && $npass==$rnpass)
    {
	if (isset($userName))
	{
		$password=$_POST['password'];
		$sql="UPDATE user SET password='$npass' WHERE userName='$userName'";
		if(mysqli_query($con,$sql))
		{
			header("Location:nuser.php");
		}
		else
		{
			echo "Error in updating: ".mysqli_error($con);
		}
		mysqli_close($con);
    }
}
}
?>

  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
