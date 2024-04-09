<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Application Form</title>
    <link rel="stylesheet" href="application.css">
</head>
<body>
    <div class="form-container">
        <h2>Scholarship Application Form</h2>
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="10th_marks">10th Marks (%):</label>
                <input type="number" id="tenth_marks" name="tenth_marks" required>
            </div>
            <div class="form-group">
                <label for="12th_marks">12th Marks (%):</label>
                <input type="number" id="twelfth_marks" name="twelfth_marks" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <select id="state" name="state" required>
                    <option value="" disabled selected>Select State</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <!-- Add more states here -->
                </select>
            </div>
            <div class="form-group">
                <label for="nationality">Nationality:</label>
                <select id="nationality" name="nationality" required>
                    <option value="" disabled selected>Select Nationality</option>
                    <option value="Indian">Indian</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="caste">Caste:</label>
                <select id="caste" name="caste" required>
                    <option value="" disabled selected>Select Caste</option>
                    <option value="General">General</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="annual_income">Annual Income:</label>
                <input type="number" id="annual_income" name="annual_income" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
