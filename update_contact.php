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
  include 'conn.php';
  include 'session.php';

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  ?>
  <div id="header">
    <?php include 'header.php'; ?>
  </div>
  <div id="sidebar">
    <?php $active = "contact"; include 'sidebar.php'; ?>
  </div>
  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title">Update Contact Info</h1>
          </div>
        </div>
        <hr>
        <?php
        if (isset($_POST['update'])) {
          $address = mysqli_real_escape_string($conn, $_POST['address']);
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $number = mysqli_real_escape_string($conn, $_POST['contactno']);

          // Update contact details using prepared statements
          $sql = "UPDATE contact_info SET contact_address=?, contact_mail=?, contact_phone=? WHERE contact_id='1'";
          if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $address, $email, $number);
            if ($stmt->execute()) {
              echo '<div class="alert alert-success"><b>Contact Details Updated Successfully.</b></div>';
            } else {
              echo '<div class="alert alert-danger"><b>Error updating contact details.</b></div>';
            }
            $stmt->close();
          } else {
            echo '<div class="alert alert-danger"><b>Error preparing the statement.</b></div>';
          }
        }
        ?>

        <div class="row">
          <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">Contact Details</div>
              <div class="panel-body">
                <form method="post" name="change_contact" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" name="address" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Email ID</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" name="email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Contact Number</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="contactno" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                      <button class="btn btn-primary" name="update" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
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