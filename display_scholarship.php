<?php
// Connect to the database
$servername = "localhost";
$username = "preeti"; // Replace with your database username
$password = "admin"; // Replace with your database password
$dbname = "database1"; // Replace with your database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve student's information from the database
$student_info_query = "SELECT * FROM applicant WHERE student_id = '755'"; // Replace '123' with the actual student ID
$student_info_result = mysqli_query($conn, $student_info_query);

if (mysqli_num_rows($student_info_result) > 0) {
    $student_info = mysqli_fetch_assoc($student_info_result);
    
    // Query to fetch eligible scholarships based on student's information
    $eligible_scholarships_query = "SELECT * FROM criteria WHERE 
                                    tenth_marks <= '{$student_info['tenth_marks']}' AND 
                                    twelfth_marks <= '{$student_info['twelfth_marks']}' AND 
                                    annual_income <= '{$student_info['annual_income']}' AND 
                                    caste = '{$student_info['caste']}' AND 
                                    state = '{$student_info['state']}' AND 
                                    nationality = '{$student_info['nationality']}'";
    
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
        echo "No scholarships available for the student's eligibility criteria.";
    }
} else {
    echo "Student information not found.";
}

// Close the database connection
mysqli_close($conn);
?>
