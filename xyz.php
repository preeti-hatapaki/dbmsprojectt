<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Connect to your database (replace placeholders with your actual database credentials)
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_database_username';
$password = 'your_database_password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query scholarships associated with the logged-in user
    $stmt = $conn->prepare("SELECT * FROM scholarships WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $scholarships = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="scholarships.css">
<title>Scholarship Portal</title>
</head>
<body>

<h1>Scholarships Available</h1>

<ul>
    <?php foreach ($scholarships as $scholarship): ?>
    <li>
        <div class="scholarship-info">
            <div class="description">
                <h2><?php echo $scholarship['name']; ?></h2>
                <p><?php echo $scholarship['description']; ?></p>
            </div>
            <div class="amount">
                <div class="amount-box">
                    <h3>Amount:</h3>
                    <p><?php echo $scholarship['amount']; ?></p>
                </div>
            </div>
        </div>
    </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
