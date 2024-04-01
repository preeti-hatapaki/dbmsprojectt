<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("Location: home.php");
        exit(); // Ensure script termination after redirect
    }
?>
<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $company_name = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
        
        $sql="select * from company where company_name='$company_name'";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }
        $count_company = mysqli_num_rows($result);

        $sql="select * from company where email='$email'";
        $result = mysqli_query($conn, $sql);
        if(!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }
        $count_email = mysqli_num_rows($result);

        if($count_company == 0 && $count_email == 0){
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO company(company_name, email, password) VALUES('$company_name', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: clogin.php");
                    exit();
                } else {
                    die("Error inserting data: " . mysqli_error($conn));
                }
            } else {
                echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "company.php";
                </script>';
                exit(); // Ensure script termination after redirect
            }
        } else {
            if($count_company > 0){
                echo '<script>
                    alert("Company name already exists!!");
                </script>';
            }
            if($count_email > 0){
                echo '<script>
                    alert("Email already exists!!");
                </script>';
            }
            exit(); // Ensure script termination after redirect
        }
    }
?>
<?php
    include("cnavbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company SignUp Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="form" class="container">
      <h1 id="heading" class="text-center mb-4">Company SignUp Form</h1>
      <form name="form" action="csignup.php" method="POST">
          <div class="mb-3">
              <label for="user" class="form-label">Enter Company Name:</label>
              <input type="text" id="user" name="user" class="form-control" required>
          </div>
          <div class="mb-3">
              <label for="email" class="form-label">Enter Email:</label>
              <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
              <label for="pass" class="form-label">Create Password:</label>
              <input type="password" id="pass" name="pass" class="form-control" required>
          </div>
          <div class="mb-3">
              <label for="cpass" class="form-label">Retype Password:</label>
              <input type="password" id="cpass" name="cpass" class="form-control" required>
          </div>
          <button type="submit" id="btn" class="btn btn-primary" name="submit">SignUp</button>
      </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
