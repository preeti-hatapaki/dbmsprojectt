<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Scholarship Criteria Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="capplication.css">
</head>
<body>
  <div id="form">
    <h1 id="heading">Scholarship Criteria</h1>
    <form name="form" action="criteria_submission.php" method="POST">
      <div class="mb-3">
        <label for="scholarshipName" class="form-label">Enter Name of the Scholarship*:</label>
        <input type="text" class="form-control" id="scholarshipName" name="scholarshipName" required>
      </div>
      <div class="mb-3">
        <label for="state" class="form-label">Select State*:</label>
        <select class="form-select" id="state" name="state" required>
          <option selected disabled>Select State</option>
          <!-- Add options for all states -->
        </select>
      </div>
      <div class="mb-3">
        <label for="caste" class="form-label">Select Caste:</label>
        <select class="form-select" id="caste" name="caste">
          <option value="">Any</option>
          <option value="sc">SC</option>
          <option value="st">ST</option>
          <option value="obc">OBC</option>
          <option value="general">General</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="gender" class="form-label">Select Gender:</label>
        <select class="form-select" id="gender" name="gender">
          <option value="">Any</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="tenthPercent" class="form-label">Minimum 10th Percentage*:</label>
        <input type="number" class="form-control" id="tenthPercent" name="tenthPercent" min="1" max="100" required>
      </div>
      <div class="mb-3">
        <label for="twelfthPercent" class="form-label">Minimum 12th Percentage:</label>
        <input type="number" class="form-control" id="twelfthPercent" name="twelfthPercent" min="1" max="100">
      </div>
      <div class="mb-3">
        <label for="annualIncome" class="form-label">Maximum Annual Income*:</label>
        <input type="number" class="form-control" id="annualIncome" name="annualIncome" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
php