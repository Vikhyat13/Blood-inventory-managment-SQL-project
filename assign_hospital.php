<?php
$active = 'relationship';
include('head.php');
?>
<div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <h1 class="mt-4 mb-3">Assign Hospital to Blood Bank</h1>
      <form action="save_relationship.php" method="post">
        <div class="row">
          <div class="col-lg-6 mb-4">
            <label>Select Blood Bank<span style="color:red">*</span></label>
            <select name="bloodbank" class="form-control" required>
              <option value="" selected disabled>Select Blood Bank</option>
              <?php
              include 'conn.php';
              $sql = "SELECT * FROM BloodBank";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['BloodBankID'] . '">' . $row['BloodBankName'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="col-lg-6 mb-4">
            <label>Select Hospital<span style="color:red">*</span></label>
            <select name="hospital" class="form-control" required>
              <option value="" selected disabled>Select Hospital</option>
              <?php
              $sql = "SELECT * FROM Hospital";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['HospitalID'] . '">' . $row['HospitalName'] . '</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Assign</button>
      </form>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>