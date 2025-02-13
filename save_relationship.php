<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bloodbank_id = mysqli_real_escape_string($conn, $_POST['bloodbank']);
    $hospital_id = mysqli_real_escape_string($conn, $_POST['hospital']);

    // Check if the relationship already exists
    $check_sql = "SELECT * FROM ManagesHospitalBloodbank WHERE BloodBankID='$bloodbank_id' AND HospitalID='$hospital_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('This relationship already exists!');</script>";
        header("Location: assign_hospital.php");
        exit();
    }

    // Insert query
    $sql = "INSERT INTO ManagesHospitalBloodbank (BloodBankID, HospitalID)
            VALUES ('$bloodbank_id', '$hospital_id')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Relationship added successfully!');</script>";
        header("Location: view_relationships.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>