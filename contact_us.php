<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php $active = 'contact'; include 'head.php'; ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["send"])) {
        // Retrieve form data
        $name = trim($_POST['fullname']);
        $number = trim($_POST['contactno']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Validate inputs
        $errors = [];
        if (empty($name)) {
            $errors[] = "Full Name is required.";
        }
        if (empty($number) || !preg_match('/^\+?[0-9]{10,15}$/', $number)) {
            $errors[] = "Please enter a valid phone number.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }
        if (empty($message)) {
            $errors[] = "Message is required.";
        }

        // If no errors, proceed with database insertion
        if (empty($errors)) {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "BloodInventoryDB") or die("Connection error");

            // Use prepared statements to prevent SQL injection
            $sql = "INSERT INTO contact_query (Name, Email, Mobilenumber, Message, QueryDate) 
                    VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Database error. Please try again later.</b></div>';
            } else {
                // Bind parameters and execute the query
                $stmt->bind_param("ssss", $name, $email, $number, $message);
                if ($stmt->execute()) {
                    echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>Query Sent! We will contact you shortly.</b></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>There was an error. Please try again later.</b></div>';
                }
                $stmt->close();
            }
            $conn->close();
        } else {
            // Display validation errors
            foreach ($errors as $error) {
                echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><b>' . htmlspecialchars($error) . '</b></div>';
            }
        }
    }
    ?>
    <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
        <div class="container">
            <div id="content-wrap" style="padding-bottom:50px;">
                <h1 class="mt-4 mb-3">Contact</h1>
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <h3>Send us a Message</h3>
                        <form name="sentMessage" method="post">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Full Name:</label>
                                    <input type="text" class="form-control" id="name" name="fullname" required>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Phone Number:</label>
                                    <input type="tel" class="form-control" id="phone" name="contactno" required placeholder="+1234567890">
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label>Message:</label>
                                    <textarea rows="10" class="form-control" id="message" name="message" required maxlength="999" style="resize:none"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="send" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <h2>Contact Details</h2>
                        <br>
                        <p><h4>Address:</h4>R.V. College of Engineering,Bangalore,Karnartaka</p>
                        <p><h4>Email:</h4><a href="mailto:contact@bloodbank.com">contact@bloodbank.com</a></p>
                        <p><h4>Contact Number:</h4><a href="tel:+1234567890">+91 6234567891</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>