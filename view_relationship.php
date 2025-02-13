<?php
$active = 'relationship';
include('head.php');
?>
<div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <h1 class="mt-4 mb-3">Assigned Hospitals to Blood Banks</h1>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Blood Bank Name</th>
            <th>Hospital Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'conn.php';
          $sql = "SELECT b.BloodBankName, h.HospitalName 
                  FROM ManagesHospitalBloodbank m
                  JOIN BloodBank b ON m.BloodBankID = b.BloodBankID
                  JOIN Hospital h ON m.HospitalID = h.HospitalID";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr>';
                  echo '<td>' . $row['BloodBankName'] . '</td>';
                  echo '<td>' . $row['HospitalName'] . '</td>';
                  echo '</tr>';
              }
          } else {
              echo '<tr><td colspan="2" style="text-align:center;">No relationships found.</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include('footer.php'); ?>
</div>