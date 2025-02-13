<?php include 'session.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="nicEdit.js"></script>
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
    <?php $active = ""; include 'sidebar.php'; ?>
  </div>
  <div id="content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 lg-12 sm-12">
            <h1 class="page-title">Update Page Details</h1>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">Page Details</div>
              <div class="panel-body">
                <form name="update_page" method="post">
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Selected Page:</label>
                    <div class="col-sm-8">
                      <?php
                      switch ($_GET['type']) {
                        case "aboutus":
                          echo "About Us";
                          break;
                        case "donor":
                          echo "Why Donate Blood";
                          break;
                        case "needforblood":
                          echo "The Need For Blood";
                          break;
                        case "bloodtips":
                          echo "Blood Tips";
                          break;
                        case "whoyouhelp":
                          echo "Who You Can Help";
                          break;
                        case "bloodgroups":
                          echo "Blood Groups";
                          break;
                        case "universal":
                          echo "Universal Donors And Recipients";
                          break;
                      }
                      ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Page Content:</label>
                    <div class="col-sm-8">
                      <textarea cols="60" rows="10" id="area4" name="data"></textarea>
                      <script type="text/javascript">
                        bkLib.onDomLoaded(function() {
                          new nicEditor({ fullPanel: true }).panelInstance('area4');
                        });
                      </script>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                      <button class="btn btn-primary" name="submit" type="submit">Update</button>
                    </div>
                  </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                  $type = $_GET['type'];
                  $data = mysqli_real_escape_string($conn, $_POST['data']);

                  // Update page details using prepared statements
                  $sql = "UPDATE pages SET page_data=? WHERE page_type=?";
                  if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ss", $data, $type);
                    if ($stmt->execute()) {
                      echo '<div class="alert alert-success"><b>Page Data Updated Successfully.</b></div>';
                    } else {
                      echo '<div class="alert alert-danger"><b>Error updating page data.</b></div>';
                    }
                    $stmt->close();
                  } else {
                    echo '<div class="alert alert-danger"><b>Error preparing the statement.</b></div>';
                  }
                }
                ?>
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