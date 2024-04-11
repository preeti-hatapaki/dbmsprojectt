<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "preeti";
$password = "admin";
$database = "database1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    // Validate and sanitize input data

    $scholarship_name = $_POST['scholarship_name'];
    $name = $_POST['name'];
    $tenth_marks = $_POST['tenth_marks'];
    $twelfth_marks = $_POST['twelfth_marks'];
    $state = $_POST['state'];
    $nationality = $_POST['nationality'];
    $caste = $_POST['caste'];
    $gender = $_POST['gender'];
    $annual_income = $_POST['annual_income'];

    // Check if the table already exists
    $sql_check_table = "SHOW TABLES LIKE '$scholarship_name'";
    $result_check_table = $conn->query($sql_check_table);

    if ($result_check_table->num_rows == 0) {
        // Table doesn't exist, create a new table
        $sql_create_table = "CREATE TABLE $scholarship_name (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            tenth_marks FLOAT,
            twelfth_marks FLOAT,
            state VARCHAR(30),
            nationality VARCHAR(30),
            caste VARCHAR(30),
            gender VARCHAR(30),
            annual_income FLOAT,
            applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($sql_create_table) === FALSE) {
            echo "Error creating table: " . $conn->error;
            exit();
        }
    }

    // Insert applicant's details into the scholarship table
    $sql_insert = "INSERT INTO $scholarship_name (name, tenth_marks, twelfth_marks, state, nationality, caste, gender, annual_income) 
                   VALUES ('$name', '$tenth_marks', '$twelfth_marks', '$state', '$nationality', '$caste','$gender', '$annual_income')";

    if ($conn->query($sql_insert) === FALSE) {
        echo "Error inserting data: " . $conn->error;
        exit();
    }

    // Redirect after successful submission
    header("Location: submit.php");
    exit();
}

// Retrieve data from the 'applicant' table
$sql_retrieve_data = "SELECT * FROM applicant";
$result_retrieve_data = $conn->query($sql_retrieve_data);

if ($result_retrieve_data->num_rows > 0) {
    // Fetch and insert data into the respective scholarship tables
    while ($row = $result_retrieve_data->fetch_assoc()) {
        $scholarship_name = $row['scholarship_name'];
        $name = $row['name'];
        $tenth_marks = $row['tenth_marks'];
        $twelfth_marks = $row['twelfth_marks'];
        $state = $row['state'];
        $nationality = $row['nationality'];
        $caste = $row['caste'];
        $gender = $row['gender'];
        $annual_income = $row['annual_income'];

        // Check if the scholarship table exists
        $sql_check_table = "SHOW TABLES LIKE '$scholarship_name'";
        $result_check_table = $conn->query($sql_check_table);

        if ($result_check_table->num_rows == 0) {
            // Create a new table for the scholarship
            $sql_create_table = "CREATE TABLE $scholarship_name (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                tenth_marks FLOAT,
                twelfth_marks FLOAT,
                state VARCHAR(30),
                nationality VARCHAR(30),
                caste VARCHAR(30),
                gender VARCHAR(30),
                annual_income FLOAT,
                applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";

            if ($conn->query($sql_create_table) === FALSE) {
                echo "Error creating table: " . $conn->error;
                continue; // Skip to the next iteration
            }
        }

        // Insert applicant's details into the scholarship table
        $sql_insert = "INSERT INTO $scholarship_name (name, tenth_marks, twelfth_marks, state, nationality, caste, gender, annual_income) 
                       VALUES ('$name', '$tenth_marks', '$twelfth_marks', '$state', '$nationality', '$caste','$gender', '$annual_income')";

        if ($conn->query($sql_insert) === FALSE) {
            echo "Error inserting data: " . $conn->error;
        }
    }
} else {
    echo "No data found in the 'applicant' table.";
}

// Close database connection
$conn->close();
?>
