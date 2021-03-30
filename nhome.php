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
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="CSS/table.css">

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
  <div class="middle" style="background-color:#bbb;"><?php
    $name=$_SESSION['name'];
    echo "<h5>Welcome $name</h5>";


    ?>

      <?php

  $con=mysqli_connect("localhost","root","","db");
  if(!$con)
  {
    die("Connection Error: ".mysqli_connect_error()."<br/>");
  }

  $sql="SELECT id,`name`, `email`, `userName`,`type` FROM user ";
  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result)>0)
   {
    ?>

    <div >
      <label>Tailor & User: </label>
        <input type="text" name="myName_1" value="" id="my_name_1">
        <button type="button" name="button_1" id="btn_1">Search</button>

        <div style="border: 1px solid black;" id="content_1">

    </div>
    <script type="text/javascript">

      document.getElementById('my_name_1').addEventListener('keyup',loadResponseGet);

      function loadResponseGet(){
        var my_name = document.getElementById('my_name_1').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'ajax.php?n='+my_name, true);
        xhr.send();
        xhr.onload = function(){
            if(xhr.status == 200){
                document.getElementById('content_1').innerHTML = this.responseText;
            }else if(this.status == 404){
            document.getElementById('content_1').innerHTML = "404 - NOT FOUND!";
          }
        };
      }

    </script>

<div >
    <table  border='1' cellpadding='8' >
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Usertype</th>
        <th>Actions</th>
      </tr>
    <?php
    while($row=mysqli_fetch_array($result))
    {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['email']."</td>";
      echo "<td>".$row['userName']."</td>";
      echo "<td>".$row['type']."</td>";
      echo '<td><a href="useredit.php? id='.$row['id'].'&Name=' .$row['name'].'&Email='.$row['email'].'&Username='.$row['userName'].'&Usertype='.$row['type'].'">Edit</a> || <a href="userdelete.php?id=' .$row['id'].'">Delete</a></td>';
      echo "</tr>";

      }

    echo "</table>";
   }
   else
   {
    echo "No data found.<br/>";
   }



    $sql="SELECT id,`name`, `email`, `userName`,`type` FROM tailor ";
  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result)>0)
{
    ?>
    <table border='1' cellpadding='8' >
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Usertype</th>
        <th>Actions</th>
      </tr>

    <?php
    while($row=mysqli_fetch_array($result))
    {
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['email']."</td>";
      echo "<td>".$row['userName']."</td>";
      echo "<td>".$row['type']."</td>";
      echo '<td><a href="tailoredit.php? id='.$row['id'].'&Name=' .$row['name'].'&Email='.$row['email'].'&Username='.$row['userName'].'&Usertype='.$row['type'].'">Edit</a> || <a href="tailordelete.php?id=' .$row['id'].'">Delete</a></td>';
      echo "</tr>";


    }
    echo "</table>";
   }
   else
   {
    echo "No data found.<br/>";
   }



mysqli_close($con);
?>

    </div>

</div>
</body>
</html>

<?php
if(isset($_POST['register']))
{
  $con=mysqli_connect("localhost","root","","db");
  if(!$con)
  {
    die("Connection Error: ".mysqli_connect_error()."<br/>");
  }
  //Row Insert
 $name=$_POST['Name'];
  $email=$_POST['email'];
  $userName=$_POST['userName'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];
  $gender=$_POST['gender'];
  $dob=$_POST['dob'];
  $usertype=$_POST['type'];
 $sql="INSERT INTO `user`(`name`, `email`, `userName`, `password`, `gender`, `dob`, `picture`, `type`)VALUES('$name','$email','$userName','$password','$gender','$dob','','$usertype')";
  if(mysqli_query($con,$sql))
  {
    header("Location:nhome.php");
  }
  else
  {
    echo "Error in inserting: ".mysqli_error($con);
  }
mysqli_close($con);
}
?>
