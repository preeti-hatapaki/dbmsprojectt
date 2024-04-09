<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $username = "preeti";
    $password = "admin";
    $database = "database1"; // Update with your database name

    // Connect to the database
    $conn = mysqli_connect("localhost", $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to generate UUID
    function generateUUID() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    // Generate unique ID
    $unique_id = generateUUID();

    // Check if the generated UUID already exists in the database
    $sql_check = "SELECT COUNT(*) AS count FROM criteria WHERE scholarship_id = '$unique_id'";
    $result_check = mysqli_query($conn, $sql_check);
    if (!$result_check) {
        die("Error checking UUID: " . mysqli_error($conn));
    }
    $row_check = mysqli_fetch_assoc($result_check);
    if ($row_check['count'] > 0) {
        // If the generated UUID already exists, generate a new one
        $unique_id = generateUUID();
    }

    // Sanitize and validate form inputs
    $scholarship_name = mysqli_real_escape_string($conn, $_POST['scholarship_name']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $grant_amount = intval($_POST['grant_amount']); // Ensure grant amount is an integer
    $tenth_marks = intval($_POST['tenth_marks']); // Ensure tenth marks is an integer
    $twelfth_marks = intval($_POST['twelfth_marks']); // Ensure twelfth marks is an integer
    $state = isset($_POST['state']) ? mysqli_real_escape_string($conn, implode(",", $_POST['state'])) : ''; // Sanitize and check state input
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $caste = mysqli_real_escape_string($conn, implode(",", $_POST['caste']));
    $annual_income = intval($_POST['annual_income']); // Ensure annual income is an integer
    $gender = isset($_POST['gender']) ? implode(',', $_POST['gender']) : ''; // Convert array to comma-separated string

    // Insert data into the database
    $sql = "INSERT INTO criteria (scholarship_name, company_name, grant_amount, tenth_marks, twelfth_marks, state, nationality, caste, annual_income, gender, scholarship_id) 
            VALUES ('$scholarship_name', '$company_name', $grant_amount, $tenth_marks, $twelfth_marks, '$state', '$nationality', '$caste', $annual_income, '$gender', '$unique_id')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to a success page
        header("Location: chome.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the request method is not POST, redirect to the form page
    header("Location: criteria.php");
    exit();
}
?>
