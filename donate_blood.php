<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function validateForm() {
      const mobileNumber = document.forms["donor"]["mobileno"].value;
      const age = document.forms["donor"]["age"].value;

      // Validate Mobile Number
      if (!/^\d{10}$/.test(mobileNumber)) {
        alert("Failed: Please enter exactly 10 digits for the mobile number.");
        return false; // Prevent form submission
      }

      // Validate Age
      if (age < 18 || age > 65) {
        alert("Failed: Your age should be between 18 and 65.");
        return false; // Prevent form submission
      }

      return true; // Allow form submission
    }
  </script>
</head>
<body>
<?php
$active = 'donate';
include('head.php');
?>
<div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="mt-4 mb-3">Donate Blood</h1>
        </div>
      </div>
      <form name="donor" action="savedata.php" method="post" onsubmit="return validateForm();">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Full Name<span style="color:red">*</span></div>
            <div><input type="text" name="fullname" class="form-control" required></div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
            <div>
              <input type="text" name="mobileno" class="form-control" required 
                     pattern="\d{10}" minlength="10" maxlength="10" 
                     title="Please enter exactly 10 digits (numbers only)">
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Email Id</div>
            <div><input type="email" name="emailid" class="form-control"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Age<span style="color:red">*</span></div>
            <div>
              <input type="number" name="age" class="form-control" required min="18" max="65" 
                     title="Age must be between 18 and 65">
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Gender<span style="color:red">*</span></div>
            <div>
              <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Blood Group<span style="color:red">*</span></div>
            <div>
              <select name="blood" class="form-control" required>
                <option value="" selected disabled>Select</option>
                <?php
                include 'conn.php';
                $sql = "SELECT DISTINCT BloodGroup FROM Blood";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['BloodGroup'] . '">' . $row['BloodGroup'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Address<span style="color:red">*</span></div>
            <div><textarea class="form-control" name="address" required></textarea></div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>