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
  <link rel="stylesheet" type="text/css" href="CSS/table.css">
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

  $sql="SELECT `oid`, `tid`, `eid`, `Done/Not` FROM `delivery` ";
  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result)>0)
   {
    ?>
    <table border='1' cellpadding='8'>
      <tr>
        <th>Order Id</th>
        <th>Tailor Id</th>
        <th>Employee Id</th>
        <th>Done/Not</th>

      </tr>
    <?php
    while($row=mysqli_fetch_array($result))
    {
      echo "<tr>";
      echo "<td>".$row['oid']."</td>";
      echo "<td>".$row['tid']."</td>";
      echo "<td>".$row['eid']."</td>";
      echo "<td>".$row['Done/Not']."</td>";

      echo "</tr>";


    }
    echo "</table>";
   }
   else
   {
    echo "No data found.<br/>";
   }


?>
     </div>

  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
