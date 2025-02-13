<?php include 'session.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    #sidebar {
      position: relative;
      margin-top: -20px;
    }
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
    .form-group {
      margin-bottom: 15px;
    }
  </style>
</head>
<body style="color:black">
  <?php
  include 'conn.php'; // Database connection
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  ?>
  <div id="header">
    <?php $active = "add"; include 'header.php'; ?>
  </div>
  <div id="sidebar">
    <?php include 'sidebar.php'; ?>
  </div>
  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title">Add Donor</h1>
          </div>
        </div>
        <hr>
        <form name="donor" action="save_donor_data.php" method="post">
          <div class="row">
            <!-- Full Name -->
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Full Name<span style="color:red">*</span></div>
              <input type="text" name="fullname" class="form-control" placeholder="Enter full name" required>
            </div>
            <!-- Mobile Number -->
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
              <input type="text" name="mobileno" class="form-control" placeholder="Enter 10-digit mobile number" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number" required>
            </div>
            <!-- Email ID -->
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Email ID</div>
              <input type="email" name="emailid" class="form-control" placeholder="Enter email address">
            </div>
          </div>
          <div class="row">
            <!-- Age -->
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Age<span style="color:red">*</span></div>
              <input type="number" name="age" class="form-control" placeholder="Enter age" min="18" max="100" required>
            </div>
            <!-- Gender -->
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Gender<span style="color:red">*</span></div>
              <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <!-- Blood Group -->
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <select name="blood" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <?php
                include 'conn.php';
                $sql = "SELECT * FROM Blood";
                $result = mysqli_query($conn, $sql) or die("Query failed.");
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['BloodGroup'] . '">' . $row['BloodGroup'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <!-- Address -->
            <div class="col-lg-12 mb-4">
              <div class="font-italic">Address<span style="color:red">*</span></div>
              <textarea class="form-control" name="address" rows="3" placeholder="Enter address" required></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  } else {
    echo '<div class="alert alert-danger"><b>Please Login First To Access Admin Portal.</b></div>';
  ?>
  <form method="post" name="" action="login.php" class="form-horizontal">
    <div class="form-group">
      <div class="col-sm-8 col-sm-offset-4" style="float:left">
        <button class="btn btn-primary" name="submit" type="submit">Go to Login Page</button>
      </div>
    </div>
  </form>
  <?php } ?>
</body>
</html>