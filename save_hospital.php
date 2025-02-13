<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $bloodbank_id = mysqli_real_escape_string($conn, $_POST['bloodbank_id']);

    // Validate inputs
    if (empty($name) || empty($location) || empty($bloodbank_id)) {
        echo "<script>alert('All fields are required!');</script>";
        exit();
    }

    // Check if the BloodBankID exists in the BloodBank table
    $check_sql = "SELECT BankID FROM BloodBank WHERE BankID = '$bloodbank_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) == 0) {
        echo "<script>alert('Error: Blood Bank ID does not exist. Please provide a valid Blood Bank ID.');</script>";
        exit();
    }

    // Insert query (without specifying HospitalID)
    $sql = "INSERT INTO Hospital (Name, Location, BloodBankID)
            VALUES ('$name', '$location', '$bloodbank_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Hospital added successfully!');</script>";
        header("Location: hospital_list.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>