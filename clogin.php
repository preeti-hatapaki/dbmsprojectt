<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: home.php");
    exit(); // Ensure script termination after redirect
}
?>
<?php
$login = false;
include('connection.php');
if (isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM company WHERE company_name = '$company_name' OR email = '$company_name'";  
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  

    if($row){  
        if(password_verify($password, $row["password"])){
            $login = true;
            session_start();

            $_SESSION['username'] = $row['company_name'];
            $_SESSION['loggedin'] = true;
            header("Location: home.php");
            exit();
        }
    } else {  
        echo '<script>
            alert("Login failed. Invalid company name or password!!");
            window.location.href = "clogin.php";
        </script>';
        exit(); // Ensure script termination after redirect
    }
}
?>
<?php 
include("connection.php");
include("cnavbar.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br><br>
    <div id="form">
        <h1 id="heading">Login Form</h1>
        <form name="form" action="clogin.php" method="POST" onsubmit="return isValid()">
            <label>Enter Company Name/Email: </label>
            <input type="text" id="company_name" name="company_name" required><br><br>
            <label>Password: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            <input type="submit" id="btn" value="Login" name="submit">
        </form>
    </div>
    <script>
        function isValid() {
            var company_name = document.getElementById('company_name').value;
            if(company_name.length == 0) {
                alert("Enter company name or email id!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
