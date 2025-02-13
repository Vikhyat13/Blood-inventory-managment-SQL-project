
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
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .form-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .form-group label {
      font-weight: bold;
      color: #555;
    }
    .form-group input,
    .form-group select {
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 10px;
      width: 100%;
    }
    .btn-submit {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    .btn-submit:hover {
      background-color: #0056b3;
    }
    .text-center a {
      color: #007bff;
      text-decoration: none;
    }
    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
<?php 
$active ='about';
include('head.php');
?>
<div class="form-container">
  <h2>Add Blood Bank</h2>
  <form action="save_bloodbank.php" method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter blood bank name" required>
    </div>
    <div class="form-group">
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" placeholder="Enter location" required>
    </div>
    <div class="form-group">
      <label for="admin_id">Admin ID:</label>
      <select id="admin_id" name="admin_id" required>
        <option value="">-- Select an Admin ID --</option>
        <option value="U001">U001</option>
        <option value="U002">U002</option>
        <option value="U003">U003</option>
      </select>
    </div>
    <div class="form-group">
      <label for="available_blood_group_no">Available Blood Group No:</label>
      <input type="text" id="available_blood_group_no" name="available_blood_group_no" placeholder="Example: A+:50,  A-:50" required>
      <small class="text-muted">Format: Blood Group:Count (e.g., A+:50, A-:50)</small>
    </div>
    <button type="submit" class="btn-submit">Add Blood Bank</button>
  </form>
  <div class="text-center mt-3">
    <a href="bloodbank_list.php">View All Blood Banks</a>
  </div>
</div>
</body>
</html>