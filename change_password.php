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
    <?php include 'header.php'; ?>
  </div>
  <div id="sidebar">
    <?php $active = ""; include 'sidebar.php'; ?>
  </div>
  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title">Change Password</h1>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">Password Fields</div>
              <div class="panel-body">
                <form method="post" name="chngpwd" class="form-horizontal">
                  <!-- Current Password -->
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Current Password<span style="color:red">*</span></label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="currpassword" placeholder="Enter current password" required>
                    </div>
                  </div>
                  <div class="hr-dashed"></div>
                  <!-- New Password -->
                  <div class="form-group">
                    <label class="col-sm-4 control-label">New Password<span style="color:red">*</span></label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="newpassword" placeholder="Enter new password" pattern=".{8,}" title="Password must be at least 8 characters long" required>
                    </div>
                  </div>
                  <div class="hr-dashed"></div>
                  <!-- Confirm Password -->
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Confirm Password<span style="color:red">*</span></label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" name="confirmpassword" placeholder="Re-enter new password" required>
                    </div>
                  </div>
                  <div class="hr-dashed"></div>
                  <!-- Submit Button -->
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                      <button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php
        if (isset($_POST["submit"])) {
          $username = $_SESSION['username'];
          $current_password = mysqli_real_escape_string($conn, $_POST["currpassword"]);
          $new_password = mysqli_real_escape_string($conn, $_POST["newpassword"]);
          $confirm_password = mysqli_real_escape_string($conn, $_POST["confirmpassword"]);

          // Fetch admin details from the UserAdmin table
          $sql = "SELECT * FROM UserAdmin WHERE UserID='$username'";
          $result = mysqli_query($conn, $sql);

          if ($row = mysqli_fetch_assoc($result)) {
            // Verify current password
            if (password_verify($current_password, $row['Password'])) {
              // Check if new password matches confirm password
              if ($new_password === $confirm_password) {
                // Check if new password is different from current password
                if (!password_verify($new_password, $row['Password'])) {
                  // Hash the new password
                  $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                  // Update password in the database
                  $sql1 = "UPDATE UserAdmin SET Password='$hashed_password' WHERE UserID='$username'";
                  if (mysqli_query($conn, $sql1)) {
                    echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Password Changed Successfully.</b></div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Error updating password. Please try again later.</b></div>';
                  }
                } else {
                  echo '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>New Password cannot be the same as the current password.</b></div>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>New Password and Confirm Password do not match!</b></div>';
              }
            } else {
              echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Current Password is incorrect!</b></div>';
            }
          } else {
            echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>User not found. Please log in again.</b></div>';
          }
        }
        ?>
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