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
			<legend>Profile Picture</legend>
            <form name="apic" action="upload.php" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit" onClick="CreateCookie()">
		    </form>
		   </fieldset>
  </div>
	<script>
  var my_form = document.forms.apic;

  my_form.onsubmit = function(){
    var f_pic_val = my_form.fileToUpload.value;

    if(f_pic_val == "" ) {
        alert("Picture must be Add");
        return false;
      }
  };

 //cookie
  function CreateCookie()

  {
    var cookieValue = document.from.name.value + ";";
    console.log(cookieValue);
    document.cookie = "name = " + cookieValue;
  }

</script>
  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
