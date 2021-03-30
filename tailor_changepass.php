<?php
session_start();
$userName=$_SESSION['userName'];
$name=$_SESSION['name'];
$opErr = $rpErr = $npErr = "";
if(!isset($_SESSION['userName']))
{
  header("Location:login.php");
}
?>

    <?php
    $con=mysqli_connect("localhost","root","","db");
  if(!$con)
  {
    die("Connection Error: ".mysqli_connect_error()."<br/>");
  }
    $sql="SELECT * FROM tailor WHERE userName='$userName'";
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
      if ($password!=$cpass || $cpass == "" ){
        $opErr = "<span style='color: red'>Old Password did not match!</span>";}
      else  if($npass == "" ){
          $npErr = "<span style='color: red'>Enter new Password </span>";}
      else  if ($npass!=$rnpass || $rnpass == ""){
        $rpErr = "<span style='color: red'>Retyped Password did not match!</span>";}
      else  if($password==$cpass && $npass==$rnpass)
      {
  	if (isset($userName))
  	{
  		$password=$_POST['password'];
  		$sql="UPDATE tailor SET password='$npass' WHERE userName='$userName'";
  		if(mysqli_query($con,$sql))
  		{
  			header("Location:ntailor.php");
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

  <li><a href="ntailor.php">Dashboard</a></li>
  <li><a href="tailor_view.php?userName=<?php echo $userName; ?>">View Profile</a></li>
  <li><a href="tailor_edit.php">Edit Profile</a></li>
  <li><a href="tailor_changepic.php">Change Profile Picture</a></li>
  <li><a href="tailor_changepass.php">Change Password</a></li>
  <li><a href="tailor_taken_order.php">Order List</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
  </div>
  <div class="middle" style="background-color:#bbb;">

     <fieldset align="center">
			<legend>Change Password</legend>
			<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<table align="left">
          <tr>
						<td>Current Password</td>
						<td><input type="password" name="cpass"> <?php echo $opErr; ?></td>
					</tr>
					<tr>
						<td><p style="color: green">New Password</p></td>
						<td><input type="password" name="npass"> <?php echo $npErr; ?></td>
					</tr>
					<tr>
						<td><p style="color: red">Retype New Password</p></td>
						<td><input type="password" name="rnpass"><?php echo $opErr; ?></td>
					</tr>
					<tr>
						<td></td>

						<td><input type="submit" name="change" value="Submit"/></td>
					</tr>
				</table>
			</form>
		</fieldset>
  </div>



  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
