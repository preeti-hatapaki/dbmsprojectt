<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: clogin.php");
    exit();
}

include('connection.php');

// Retrieve scholarships listed by the logged-in company
$company_name = $_SESSION['username'];
$sql = "SELECT * FROM criteria WHERE company_name = '$company_name'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error fetching scholarships: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Scholarships</title>
    <!-- Add any necessary CSS or Bootstrap CDN links here -->
</head>
<body>
    <h1>View Scholarships</h1>
    <table>
        <tr>
            <th>Scholarship Name</th>
            <th>Grant Amount</th>
            <!-- Add more table headers as needed -->
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['scholarship_name']; ?></td>
                <td><?php echo $row['grant_amount']; ?></td>
                <!-- Display more scholarship details here -->
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
