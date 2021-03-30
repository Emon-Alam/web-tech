<?php

require "includes/db_connect.inc.php";
$namet = "";
$flag_get = 0;
header("Content-Type:application/json");

if($_SERVER["REQUEST_METHOD"]=="GET" && count($_GET)>0){
  $flag_get = 1;
  if(!empty($_GET['n'])){
    $namet = $_GET['n'];
    $sql = "select * from user where name like '%$namet%';";
    $result = mysqli_query($conn, $sql);
  }

  else{
    $sql = "select * from user;";
    $result = mysqli_query($conn, $sql);
  }
}
else{
  echo '{ "error": "Something went wrong" }';
}

?>
<?php if($flag_get==1){ ?>
[
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
  {
          "id": <?php echo $row['ID']; ?>,
          "name": "<?php echo $row['name']; ?>",
          "email": "<?php echo $row['email']; ?>",
          "username": "<?php echo $row['userName']; ?>",
          "gender": "<?php echo $row['gender']; ?>",
          "type": "<?php echo $row['type']; echo "\"\n";?>
        },
      <?php } ?>
]
<?php } ?>
