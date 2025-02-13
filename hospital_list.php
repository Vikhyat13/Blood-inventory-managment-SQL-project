<?php
$active = 'hospital';
include('head.php'); // Include the head section
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    #content {
      position: relative;
      margin-left: 210px;
    }
    @media screen and (max-width: 600px) {
      #content {
        position: relative;
        margin-left: auto;
        margin-right: auto;
      }
    }
    .btn-action {
      margin: 2px;
    }
  </style>
</head>
<body style="color:black">
<div id="content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 lg-12 sm-12">
          <h1 class="page-title">List of Hospitals</h1>
        </div>
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <?php
              include 'conn.php';

              // Fetch column names from the Hospital table
              $sql_columns = "SHOW COLUMNS FROM Hospital";
              $result_columns = mysqli_query($conn, $sql_columns);

              if (mysqli_num_rows($result_columns) > 0) {
                  while ($column = mysqli_fetch_assoc($result_columns)) {
                      echo '<th scope="col">' . htmlspecialchars(ucwords(str_replace('_', ' ', $column['Field']))) . '</th>';
                  }
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch all rows from the Hospital table
            $sql = "SELECT * FROM Hospital";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    foreach ($row as $value) {
                        echo '<td>' . htmlspecialchars($value) . '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                // Display a message if no rows are found
                echo '<tr><td colspan="' . mysqli_num_fields($result_columns) . '" class="text-center">No hospitals found.</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>