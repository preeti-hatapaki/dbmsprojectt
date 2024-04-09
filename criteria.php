<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Criteria Form</title>
    <link rel="stylesheet" type="text/css" href="criteria.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Scholarship Criteria Form</h2>
        <form action="cprocess.php" method="POST">
            <div class="form-group">
                <label for="scholarship_name">Scholarship Name:</label>
                <input type="text" id="scholarship_name" name="scholarship_name" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="grant_amount">Grant Amount:</label>
                <input type="number" id="grant_amount" name="grant_amount" required>
            </div>
            <div class="form-group">
                <label for="tenth_marks">10th Marks (%):</label>
                <input type="number" id="tenth_marks" name="tenth_marks" required>
            </div>
            <div class="form-group">
                <label for="twelfth_marks">12th Marks (%):</label>
                <input type="number" id="twelfth_marks" name="twelfth_marks" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender[]" class="js-example-basic-multiple" multiple >
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
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
                <select id="caste" name="caste[]" class="js-example-basic-multiple" multiple required>
                    <option value="General">General</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                </select>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <select id="state" name="state[]" class="js-example-basic-multiple" multiple required>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <!-- Add more states here -->
                </select>
            </div>
            <div class="form-group">
                <label for="annual_income">Annual Income:</label>
                <input type="number" id="annual_income" name="annual_income" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            // Add functionality to dynamically add new options for caste and state
            $('#caste, #state').on('select2:select', function (e) {
                var data = e.params.data;
                if (data.id === 'other') {
                    var newValue = prompt("Enter a new value:");
                    if (newValue) {
                        var option = new Option(newValue, newValue, true, true);
                        $(this).append(option).trigger('change');
                    }
                }
            });

            // Add functionality to dynamically add new gender options
            $('#gender').on('select2:select', function (e) {
                var data = e.params.data;
                if (data.id === 'other') {
                    var newGender = prompt("Enter a new gender:");
                    if (newGender) {
                        var option = new Option(newGender, newGender, true, true);
                        $(this).append(option).trigger('change');
                    }
                }
            });
        });
    </script>
</body>
</html>
