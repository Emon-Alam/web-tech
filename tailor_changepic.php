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
  <link rel="stylesheet" type="text/css" href="CSS/cpic.css">
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
			<legend>Profile Picture</legend>
            <form action="tupload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		    </form>
		   </fieldset>
  </div>

  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
