<?php

require "includes/db_connect.inc.php";
$namet = "";
$flag_get = 0;

if($_SERVER["REQUEST_METHOD"]=="GET" && count($_GET)>0){
  $flag_get = 1;
  if(!empty($_GET['n'])){
    $namet = $_GET['n'];
    $sql = "select * from tailor where name like '%$namet%';";
    $result = mysqli_query($conn, $sql);
  }

  else{
    $sql = "select * from tailor;";
    $result = mysqli_query($conn, $sql);
  }
}
else{
  header("Location: nhome.php");
}


$nameu = "";
$flag_get = 0;

if($_SERVER["REQUEST_METHOD"]=="GET" && count($_GET)>0){
  $flag_get = 1;
  if(!empty($_GET['n'])){
    $nameu = $_GET['n'];
    $sql = "select * from user where name like '%$nameu%';";
    $result = mysqli_query($conn, $sql);
  }

  else{
    $sql = "select * from user;";
    $result = mysqli_query($conn, $sql);
  }
}
else{
  header("Location: nhome.php");
}

?>
<?php if($flag_get==1){ ?>

  <table align="center" border="1" width="40%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
        <th>Gender</th>
        <th>Usertype</th>

      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?php echo $row['ID']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['userName']; ?></td>
          <td><?php echo $row['password']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td><?php echo $row['type']; ?></td>

        </tr>
      <?php } ?>
    </tbody>
  </table>

<?php } ?>
