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
</head>
<body style="background-image: url('admin_image/blood-cells.jpg'); background-size: cover; background-position: center;">
  <form action="" method="post">
    <div class="container" style="margin-top: 200px;">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <h1 class="mt-4 mb-3" style="color: #D2F015; text-align: center;">
            Blood Bank & Management<br>Admin Login Portal
          </h1>
        </div>
      </div>
      <div class="card" style="height: 300px; background: rgba(255, 255, 255, 0.8); border-radius: 10px;">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="font-italic" style="font-weight: bold;">Username<span style="color: red">*</span></div>
              <div><input type="text" name="username" placeholder="Enter your username" class="form-control" required></div>
            </div>
          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-lg-6">
              <div class="font-italic" style="font-weight: bold;">Password<span style="color: red">*</span></div>
              <div><input type="password" name="password" placeholder="Enter your password" class="form-control" required></div>
            </div>
          </div>
          <div class="row justify-content-center mt-4">
            <div class="col-lg-4">
              <div><input type="submit" name="login" class="btn btn-primary w-100" value="LOGIN" style="cursor: pointer;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    include 'conn.php'; // Database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["login"])) {
      $username = mysqli_real_escape_string($conn, $_POST["username"]);
      $password = mysqli_real_escape_string($conn, $_POST["password"]);

      // Debugging: Print submitted credentials
      echo "<pre>";
      echo "Submitted Username: $username\n";
      echo "Submitted Password: $password\n";
      echo "</pre>";

      // Use prepared statements to prevent SQL injection
      $sql = "SELECT * FROM admin_info WHERE admin_username = ? AND admin_password = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // Start session and redirect to dashboard
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
      } else {
        echo '<div class="alert alert-danger text-center mt-3">Invalid username or password.</div>';
      }

      $stmt->close();
    }
    ?>
  </form>
</body>
</html>