<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Custom CSS to style the image */
    body {
      background color: #7F95B1; /* Set background color to black */
    }
    .cover-image {
      width: 100%; /* Set the width to cover 100% of the container */
      max-width: 100%; /* Ensure the image does not exceed its original size */
      height: auto; /* Maintain aspect ratio */
      display: block; /* Make the image a block element */
    }
  </style>
</head>
<body style="overflow:hidden;">
  <?php 
    include "cnavbar.php";
  ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8">
        <img src="comp.avif" class="cover-image">
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
