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
    require_once('../dbConnect.php');
        $regno =  $_SESSION['regno'];
        if(isset($_POST["qblock"])){
          $blockname="Q Block";
          $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='female';" );
          $row = mysqli_fetch_array( $rowSQL );
          $largestNumber = $row['max'];
          if($largestNumber==0){
            $largestNumber=1;
          }
          $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='female';");
        $data=mysqli_fetch_assoc($result);
        $count= $data['total'];
        if($count<6){
          $roomno=$largestNumber;
        }
        else{
            $roomno=$largestNumber+1;
        }
        }
    if(isset($_POST["mblock"])){
      $blockname="M Block";
      $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='female';" );
      $row = mysqli_fetch_array( $rowSQL );
      $largestNumber = $row['max'];
      if($largestNumber==0){
        $largestNumber=1;
      }
      $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='female';");
    $data=mysqli_fetch_assoc($result);
    $count= $data['total'];
    if($count<6){
      $roomno=$largestNumber;
    }
    else{
        $roomno=$largestNumber+1;
    }
    }
    if(isset($_POST["nblock"])){
      $blockname="N Block";
      $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='female';" );
      $row = mysqli_fetch_array( $rowSQL );
      $largestNumber = $row['max'];
      if($largestNumber==0){
        $largestNumber=1;
      }
      $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='female';");
    $data=mysqli_fetch_assoc($result);
    $count= $data['total'];
    if($count<6){
      $roomno=$largestNumber;
    }
    else{
        $roomno=$largestNumber+1;
    }
    }
    if(isset($_POST["lblock"])){
      $blockname="L Block";
      $rowSQL = mysqli_query($conn, "SELECT MAX( roomno ) AS max FROM `users` WHERE block='$blockname' AND gender='female';" );
      $row = mysqli_fetch_array( $rowSQL );
      $largestNumber = $row['max'];
      if($largestNumber==0){
        $largestNumber=1;
      }
      $result=mysqli_query($conn,"SELECT count($largestNumber) as total from users where block='$blockname' AND gender='female';");
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


<form class="" action="lhregistration.php" method="post">
    <section class="cards">
<article class="card card--1">
  <div class="card__info">
    <span class="card__category"> LH Hostel</span>
    <h3 class="card__title">Q block</h3>
    <input type="submit" name="qblock" id="qblock" class="card__by" value="submit">
  </div>
</article>


<article class="card card--2">
  <div class="card__info">
    <span class="card__category"> LH Hostel</span>
    <h3 class="card__title">M block</h3>
    <input type="submit" name="mblock" id="mblock" class="card__by" value="submit">
  </div>
</article>

<article class="card card--3">
  <div class="card__info">
    <span class="card__category"> LH Hostel</span>
    <h3 class="card__title">N block</h3>
      <input type="submit" name="nblock" id="nblock" class="card__by" value="submit">
  </div>
</article>

<article class="card card--4">
  <div class="card__info">
    <span class="card__category"> LH Hostel</span>
    <h3 class="card__title">L block</h3>
      <input type="submit" name="lblock" id="lblock" class="card__by" value="submit">
  </div>
</article>
  </section>
</form>

  </body>
</html>
