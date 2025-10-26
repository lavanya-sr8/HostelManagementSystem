<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title></title>
  <link rel="stylesheet" href="..\css\mhreg.css">

  </head>
  <body>
<?php       session_start(); ?>

  <?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){

    $regno = $_SESSION['regno'];
    require_once('../dbConnect.php');
if(isset($_POST["g1block"])){

  $blockname="G1 Block";
  $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='male';" );
  $row = mysqli_fetch_array( $rowSQL );
  $largestNumber = $row['max'];
  if($largestNumber==0){
    $largestNumber=1;
  }
  $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='male';");
$data=mysqli_fetch_assoc($result);
$count= $data['total'];
if($count<6){
  $roomno=$largestNumber;
}
else{
    $roomno=$largestNumber+1;
}
}
if(isset($_POST["g2block"])){
  $blockname="G2 Block";
  $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='male';" );
  $row = mysqli_fetch_array( $rowSQL );
  $largestNumber = $row['max'];
  if($largestNumber==0){
    $largestNumber=1;
  }
  $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='male';");
$data=mysqli_fetch_assoc($result);
$count= $data['total'];
if($count<6){
  $roomno=$largestNumber;
}
else{
    $roomno=$largestNumber+1;
}
}
if(isset($_POST["g3block"])){
  $blockname="G3 block";
  $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='male';" );
  $row = mysqli_fetch_array( $rowSQL );
  $largestNumber = $row['max'];
  if($largestNumber==0){
    $largestNumber=1;
  }
  $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='male';");
$data=mysqli_fetch_assoc($result);
$count= $data['total'];
if($count<6){
  $roomno=$largestNumber;
}
else{
    $roomno=$largestNumber+1;
}
}


$sql="UPDATE `users` SET `block`='$blockname' where regno='$regno'";
$query=mysqli_query($conn,$sql);
$sql="UPDATE `users` SET `roomno`='$roomno' where regno='$regno'";
$query1=mysqli_query($conn,$sql);
if($query && $query1){
  echo 'Entry successful';
  header('Location: studentdashboard.php');
}
else{
  echo "error occoured";
}
}
   ?>
<?php include '../header.php';?>
<form class="" action="mhregistration.php" method="post">


    <section class="cards">
<article class="card card--1">
  <div class="card__info">
    <span class="card__category"> MH Hostel</span>
    <h3 class="card__title">G1 block</h3>
    <input type="submit" name="g1block" id="g1block" class="card__by" value="submit">
  </div>
</article>


<article class="card card--2">
  <div class="card__info">
    <span class="card__category"> MH Hostel</span>
    <h3 class="card__title">G2 block</h3>
        <input type="submit" name="g2block" id="g2block" class="card__by" value="submit">
  </div>
</article>

<article class="card card--3">
  <div class="card__info">
    <span class="card__category"> MH Hostel</span>
    <h3 class="card__title">G3 block</h3>
      <input type="submit" name="g3block" id="g3block" class="card__by" value="submit">
  </div>
</article>
  </section>
</form>

  </body>
</html>
