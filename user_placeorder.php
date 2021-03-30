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

  <li><a href="nuser.php">Dashboard</a></li>
  <li><a href="user_view.php?userName=<?php echo $userName; ?>">View Profile</a></li>
  <li><a href="user_edit.php">Edit Profile</a></li>
  <li><a href="user_changepic.php">Change Profile Picture</a></li>
  <li><a href="user_changepass.php">Change Password</a></li>
  <li><a href="user_placeorder.php">Place Order</a></li>

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
      if (isset($_POST['place'])) {
        $uname = $_SESSION['userName'];
        $pid = $_POST['product'];
        $tid = $_POST['tailor'];
        $desc = $_POST['desc'];
        $od = date("Y-m-d");
        $dd = date("Y-m-d", strtotime("+7 day"));
        $sql="INSERT INTO `orders`(`uname`,`pid`,`tid`,`descr`,`order_date`,`delivery_date`,`delivered`)VALUES('$uname',$pid,$tid,'$desc','$od','$dd',false)";
      if(mysqli_query($con,$sql))
      {
        echo "Order Placed!<br>";
      }
      else
      {
        echo "Error in updating: ".mysqli_error($con);
      }

      }

      $products = array();
      $tailor = array();

    $sql="SELECT * FROM `products`";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0) {
      while($row=mysqli_fetch_array($result))
      {
        $products[$row["pid"]] = $row["pname"]." (BDT".$row["price"].")";
      }
    }
    $sql="SELECT * FROM `tailor`";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0) {
      while($row=mysqli_fetch_array($result))
      {
        $tailor[$row["ID"]] = $row["name"];
      }
    }
    mysqli_close($con);
    ?>
    <form method="post">
      <label>Product: </label>
      <select name="product">
        <option value="">Select a Product...</option>
        <?php
        foreach ($products as $key => $value) {
          echo '<option value="'.$key.'">'.$value.'</option>';
        }
        ?>
      </select>
      <br/>
      <label>Tailor: </label>
      <select name="tailor">
        <option value="">Select a Tailor...</option>
        <?php
        foreach ($tailor as $key => $value) {
          echo '<option value="'.$key.'">'.$value.'</option>';
        }
        ?>
      </select><br>
      <label>Description:</label>
      <input type="text" name="desc">
      <input type="submit" name="place" value="Place Order">
    </form>
</div>
  <div class="footer">
    <p>Copyright © 2020</p>
  </div>
</div>
</body>
</html>
