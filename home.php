<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Chatbot Widget Styles */
        #chatbot-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            z-index: 1000;
        }
        .chat-container {
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            padding: 10px;
        }
        .chat-box {
            height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
        }
        .message.user {
            text-align: right;
            color: #007bff;
        }
        .message.bot {
            text-align: left;
            color: #28a745;
        }
    </style>
</head>
<body>
  <div class="header">
    <?php
    $active = "home";
    include('head.php'); 
    ?>
  </div>
  <?php include 'ticker.php'; ?>
  <div id="page-container" style="margin-top:50px; position: relative; min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:75px;">
        <img src="image/blood-donation.jpg" alt="Image" width="100%" height="500">
        <br>
        <h1 style="text-align:center;font-size:45px;">Welcome to BloodBank & Donor Management System</h1>
        <br>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">The need for blood</h4>
                    <p class="card-body overflow-auto" style="padding-left:2%;height:120px;text-align:left;">
                            There are many reasons patients need blood. Blood transfusions are required for:
                            <ul>
                                <li>Women with pregnancy complications.</li>
                                <li>Children with severe anemia.</li>
                                <li>Patients undergoing surgeries or trauma care.</li>
                            </ul>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">Blood Tips</h4>
                    <p class="card-body overflow-auto" style="padding-left:2%;height:120px;text-align:left;">
                        
                            Here are some tips for donating blood:
                            <ul>
                                <li>Stay hydrated before and after donation.</li>
                                <li>Eat a healthy meal.</li>
                                <li>Rest and relax after donation.</li>
                            </ul>
                        
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">Who you could Help</h4>
                    <p class="card-body overflow-auto" style="padding-left:2%;height:120px;text-align:left;">
                        
                            Donating blood can help:
                            <ul>
                                <li>People in emergencies or disasters.</li>
                                <li>Patients undergoing surgeries.</li>
                                <li>Women with pregnancy complications.</li>
                                <li>Patients with chronic conditions like thalassemia or sickle cell disease.</li>
                            </ul>
                        
                    </p>
                </div>
            </div>
        </div>
        <h2>Blood Donor Names</h2>
        <div class="row">
          <?php
            include 'conn.php';
            $sql = "SELECT * FROM Donor JOIN Blood ON Donor.DonorBloodGroup=Blood.BloodGroup ORDER BY RAND() LIMIT 6";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="col-lg-4 col-sm-6 portfolio-item"><br>
              <div class="card" style="width:300px">
                <img class="card-img-top" src="image\blood_drop_logo.jpg" alt="Card image" style="width:100%;height:300px">
                <div class="card-body">
                  <h3 class="card-title"><?php echo htmlspecialchars($row['DonorName']); ?></h3>
                  <p class="card-text">
                    <b>Blood Group : </b> <b><?php echo htmlspecialchars($row['DonorBloodGroup']); ?></b><br>
                    <b>Mobile No. : </b> <?php echo htmlspecialchars($row['DonorMobile']); ?><br>
                    <b>Gender : </b><?php echo htmlspecialchars($row['Gender']); ?><br>
                    <b>Age : </b> <?php echo htmlspecialchars($row['Age']); ?><br>
                    <b>Address : </b> <?php echo htmlspecialchars($row['DonorAddress']); ?><br>
                  </p>
                </div>
              </div>
            </div>
          <?php }} ?>
        </div>
        <br>
        <!-- Blood Groups Section -->
        <div class="row">
            <div class="col-lg-6">
                <h2>BLOOD GROUPS</h2>
                <p>
                    Blood groups include:
                    <ul>
                        <li>A+, A-</li>
                        <li>B+, B-</li>
                        <li>O+, O-</li>
                        <li>AB+, AB-</li>
                    </ul>
                </p>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="image\blood_donationcover.jpeg" alt="">
            </div>
        </div>
        <!-- Universal Donors Section -->
        <hr>
        <div class="row mb-4">
            <div class="col-md-8">
                <h4>UNIVERSAL DONORS AND RECIPIENTS</h4>
                <p>
                    O- is the universal donor blood group, while AB+ is the universal recipient blood group.
                </p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block" href="donate_blood.php" style="align:center; background-color:#7FB3D5;color:#273746">Become a Donor</a>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card text-center" style="height:200px;">
            <div class="card-body">
                <h4 class="card-title">Register a Blood Bank</h4>
                <p class="card-text">Add a new blood bank to the system.</p>
                <a href="add_bloodbank.php" class="btn btn-primary">Register Blood Bank</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card text-center" style="height:200px;">
            <div class="card-body">
                <h4 class="card-title">View Blood Banks</h4>
                <p class="card-text">View the list of all registered blood banks.</p>
                <a href="bloodbank_list.php" class="btn btn-info">View Blood Banks</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card text-center" style="height:200px;">
            <div class="card-body">
                <h4 class="card-title">Register a Hospital</h4>
                <p class="card-text">Add a new hospital to the system.</p>
                <a href="add_hospital.php" class="btn btn-primary">Register Hospital</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card text-center" style="height:200px;">
            <div class="card-body">
                <h4 class="card-title">View Hospitals</h4>
                <p class="card-text">View the list of all registered hospitals.</p>
                <a href="hospital_list.php" class="btn btn-info">View Hospitals</a>
            </div>
        </div>
    </div>
</div>
  
  <?php include('footer.php'); ?>
</div>

<!-- Chatbot Widget -->
<div id="chatbot-widget">
    <div class="chat-container">
        <h5 class="text-center">Blood Bank Chatbot</h5>
        <div class="chat-box" id="chat-box"></div>
        <form id="chat-form" method="POST" action="chatbot.php">
            <div class="input-group">
                <input type="text" name="message" id="user-input" class="form-control" placeholder="Type your message..." required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Chatbot -->
<script>
    $(document).ready(function () {
        $('#chat-form').on('submit', function (e) {
            e.preventDefault(); // Prevent form from submitting normally

            const userInput = $('#user-input').val();
            if (!userInput.trim()) return;

            // Append user's message to the chat box
            $('#chat-box').append(`<div class="message user"><strong>You:</strong> ${userInput}</div>`);

            // Clear input field
            $('#user-input').val('');

            // Send AJAX request to chatbot.php
            $.ajax({
                url: 'chatbot.php',
                type: 'POST',
                data: { message: userInput },
                success: function (response) {
                    // Append bot's response to the chat box
                    $('#chat-box').append(`<div class="message bot"><strong>Bot:</strong> ${response}</div>`);
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight); // Scroll to bottom
                },
                error: function () {
                    $('#chat-box').append('<div class="message bot"><strong>Bot:</strong> Sorry, there was an error processing your request.</div>');
                }
            });
        });
    });
</script>
</body>
</html>