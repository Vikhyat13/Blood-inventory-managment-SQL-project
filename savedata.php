<?php
// Retrieve form data
$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood'];
$address = $_POST['address'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "BloodInventoryDB") or die("Connection error");

// Generate a unique DonorID
do {
    $id = 'D' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
    $check_sql = "SELECT DonorID FROM Donor WHERE DonorID='$id'";
    $check_result = mysqli_query($conn, $check_sql);
} while (mysqli_num_rows($check_result) > 0); // Repeat until a unique ID is found

// Insert donor data into the Donor table
$sql = "INSERT INTO Donor (DonorID, DonorName, DonorMobile, DonorMail, Age, Gender, DonorBloodGroup, DonorAddress)
        VALUES ('$id', '$name', '$number', '$email', '$age', '$gender', '$blood_group', '$address')";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Redirect to the home page
    header("Location: http://localhost/BDMS/home.php");
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
