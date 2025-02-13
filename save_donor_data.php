<?php
include 'conn.php'; // Database connection

// Retrieve and sanitize form data
$name = mysqli_real_escape_string($conn, $_POST['fullname']);
$number = mysqli_real_escape_string($conn, $_POST['mobileno']);
$email = mysqli_real_escape_string($conn, $_POST['emailid']);
$age = intval($_POST['age']); // Ensure age is an integer
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$blood_group = mysqli_real_escape_string($conn, $_POST['blood']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

// Prepare and execute the insert query using prepared statements
$sql = "INSERT INTO Donor (DonorName, DonorMobile, DonorMail, Age, Gender, DonorBloodGroup, DonorAddress) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    // Bind parameters to the prepared statement
    $stmt->bind_param("sssisss", $name, $number, $email, $age, $gender, $blood_group, $address);

    if ($stmt->execute()) {
        // Redirect to donor list page after successful insertion
        header("Location: donor_list.php");
        exit; // Stop script execution after redirect
    } else {
        echo "Error: Could not save donor data.";
    }

    $stmt->close();
} else {
    echo "Error: Could not prepare the statement.";
}

// Close the connection
mysqli_close($conn);
?>