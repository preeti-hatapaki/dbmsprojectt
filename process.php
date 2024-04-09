<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "preeti";
    $password = "admin";
    $database = "database1";

    $conn = mysqli_connect("localhost", $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function generateUniqueID($conn) {
        $last_id_query = "SELECT MAX(CAST(SUBSTRING(unique_id, 1, 3) AS UNSIGNED)) AS max_id FROM applicant";
        $last_id_result = mysqli_query($conn, $last_id_query);
        $row = mysqli_fetch_assoc($last_id_result);
        $last_id = $row['max_id'];
        $next_id = $last_id + 1;
        $unique_id = sprintf('%03d', $next_id);
        return $unique_id;
    }

    $unique_id = generateUniqueID($conn);

    $sql_check = "SELECT COUNT(*) AS count FROM applicant WHERE unique_id = '$unique_id'";
    $result_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    if ($row_check['count'] > 0) {
        $unique_id = generateUniqueID($conn);
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $tenth_marks = mysqli_real_escape_string($conn, $_POST['tenth_marks']);
    $twelfth_marks = mysqli_real_escape_string($conn, $_POST['twelfth_marks']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $caste = mysqli_real_escape_string($conn, $_POST['caste']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']); // Gender is already a string
    $annual_income = mysqli_real_escape_string($conn, $_POST['annual_income']);

    $sql = "INSERT INTO applicant (name, tenth_marks, twelfth_marks, state, nationality, caste, gender, annual_income, unique_id) 
            VALUES ('$name', '$tenth_marks', '$twelfth_marks', '$state', '$nationality', '$caste','$gender', '$annual_income', '$unique_id')";
    if (mysqli_query($conn, $sql)) {
        $eligible_scholarships_query = "SELECT * FROM criteria WHERE 
                                        tenth_marks <= '$tenth_marks' AND 
                                        twelfth_marks <= '$twelfth_marks' AND 
                                        annual_income >= '$annual_income' AND 

                                        (caste LIKE '%$caste%' OR caste = 'General,OBC,SC,ST') AND 
                                        (gender LIKE '%$gender%' OR gender = 'Male,Female,Other') AND 
                                        (state LIKE '%$state%' OR state = 'Andhra Pradesh,Arunachal Pradesh') AND 
                                        nationality = '$nationality'";
        
        $eligible_scholarships_result = mysqli_query($conn, $eligible_scholarships_query);
        
        if (mysqli_num_rows($eligible_scholarships_result) > 0) {
            echo "<h2>Eligible Scholarships</h2>";
            echo "<div class='scholarships-container'>";
            while ($row = mysqli_fetch_assoc($eligible_scholarships_result)) {
                echo "<div class='scholarship'>";
                echo "<div class='scholarship-name'>" . $row['scholarship_name'] . "</div>";
                echo "<div class='grant-amount'>" . $row['grant_amount'] . "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No scholarships available for your eligibility criteria.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
