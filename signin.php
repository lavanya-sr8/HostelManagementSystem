<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signin</title>
    <link rel="stylesheet" href="css\signin.css">
    <script type="text/javascript">
      function back(){
        window.location.href ="index.php";
      }
    </script>
  <?php
  //   $errmsg="";
  // if ($_SERVER['REQUEST_METHOD']=='POST'){

  //     session_start();
  //     require_once('dbConnect.php');
  //     $username = trim($_POST['username']);
  //     $password = $_POST['password'];
  //     // $sql= "SELECT * FROM users WHERE regno = '$username' AND password = '$password' ";
  //     $sql = "SELECT * FROM users WHERE regno = '$username' LIMIT 1";
  //     $result = mysqli_query($conn,$sql);
  //     // if(isset($check)){
  //     //       $_SESSION['regno'] = $username;
  //     //   header('Location: student\studentdashboard.php');

  //     // }
  // if ($result && mysqli_num_rows($result) === 1) {
  //         $row = mysqli_fetch_assoc($result);
  //         $hashed_password = $row['password'];

  //         // ✅ Step 2: Verify entered password with stored hash
  //         if (password_verify($password, $hashed_password)) {
  //             $_SESSION['regno'] = $username;
  //             header('Location: student/studentdashboard.php');
  //             exit();
  //         } else {
  //             $errmsg = "*Username or password is wrong";
  //         }
  //     }

  // else{
  // $errmsg="*Username or password is wrong";
  // }
  // }

      $errmsg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    require_once('dbConnect.php');

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Use prepared statements for safety
    $sql = "SELECT password FROM users WHERE regno = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = trim($row['password']);
        $password = trim($password);

        // Verify entered password with stored hash
        if (password_verify($password, $hashed_password)) {
            $_SESSION['regno'] = $username;
            header('Location: student/studentdashboard.php');
            exit();
        } else {
            $errmsg = "*Username or password is wrong";
        }
    } else {
        $errmsg = "*Username or password is wrong";
    }
}
   ?>

  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post" action="signin.php" >
        <div class="txt_field">
          <input name="username" type="text" pattern="[0-9]{2}([A-Za-z]{1}[0-9]{3}|[A-Za-z]{2}[0-9]{2,3})" required>
          <span></span>
          <label>Regno</label>
        </div>
        <div class="txt_field">
          <input name="password" type="password" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input type="submit" value="Go Back"onclick="back()" style="margin-bottom:5px;">
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="registration.php">Signup</a>
        </div>
        <span style="color:red "><?php echo "$errmsg"; ?></span>
      </form>
    </div>

  </body>
</html>
