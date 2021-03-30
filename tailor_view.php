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
      $image=$row["picture"];
      {
        echo "<h4>Profie</h4>";?>
        <img src="<?php echo $image;?>" height="80" width="80" />
        <?php
        echo "<table>";
        echo "<tr>";
        echo "<td> Name </td>";
        echo "<td>".$row["name"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Email </td>";
        echo "<td>".$row["email"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Gender </td>";
        echo "<td>".$row["gender"]."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td> Date of Birth </td>";
        echo "<td>".$row["dob"]."</td>";
        echo "</tr>";
        echo "</table>";
      }
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
