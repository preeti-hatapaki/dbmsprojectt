<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace "username" and "password" with your actual database username and password
    $username = "preeti";
    $password = "admin";
    $database = "database1"; // Update with your database name

    // Connect to database
    $conn = mysqli_connect("localhost", $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to generate UUID within the length of scholarship_id field
    function generateUUID() {
        $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );

        // Truncate UUID if it exceeds the length of scholarship_id
        return substr($uuid, 0, 255);
    }

    // Generate unique ID
    $unique_id = generateUUID();

    // Check if the generated UUID already exists in the database
    $sql_check = "SELECT COUNT(*) AS count FROM applicant WHERE unique_id = '$unique_id'";
    $result_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    if ($row_check['count'] > 0) {
        // If the generated UUID already exists, generate a new one
        $unique_id = generateUUID();
    }

    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $tenth_marks = mysqli_real_escape_string($conn, $_POST['tenth_marks']);
    $twelfth_marks = mysqli_real_escape_string($conn, $_POST['twelfth_marks']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $caste = mysqli_real_escape_string($conn, $_POST['caste']);
    $annual_income = mysqli_real_escape_string($conn, $_POST['annual_income']);

    // Insert data into database
    $sql = "INSERT INTO applicant (name, tenth_marks, twelfth_marks, state, nationality, caste, annual_income, unique_id) 
            VALUES ('$name', '$tenth_marks', '$twelfth_marks', '$state', '$nationality', '$caste', '$annual_income', '$unique_id')";
    if (mysqli_query($conn, $sql)) {
        // Query to fetch eligible scholarships based on student's information
        $eligible_scholarships_query = "SELECT * FROM criteria WHERE 
                                        tenth_marks <= '$tenth_marks' AND 
                                        twelfth_marks <= '$twelfth_marks' AND 
                                        annual_income >= '$annual_income' AND 
                                        caste = '$caste' AND 
                                        state = '$state' AND 
                                        nationality = '$nationality'";
        
        $eligible_scholarships_result = mysqli_query($conn, $eligible_scholarships_query);
        
        if (mysqli_num_rows($eligible_scholarships_result) > 0) {
            // Display the list of eligible scholarships
            echo "<h2>Eligible Scholarships</h2>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($eligible_scholarships_result)) {
                echo "<li>{$row['scholarship_name']} - {$row['grant_amount']}</li>";
            }
            echo "</ul>";
        } else {
            echo "No scholarships available for your eligibility criteria.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
