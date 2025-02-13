<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $available_blood_group_no = mysqli_real_escape_string($conn, $_POST['available_blood_group_no']);

    // Debugging: Print sanitized input
    echo "Name: $name<br>";
    echo "Location: $location<br>";
    echo "Admin ID: $admin_id<br>";
    echo "Available Blood Group No: $available_blood_group_no<br>";

    // Validate inputs
    if (empty($name) || empty($location) || empty($admin_id) || empty($available_blood_group_no)) {
        echo "<script>alert('All fields are required!');</script>";
        exit();
    }

    // Validate AvailableBloodGroupNo format (e.g., A+:50, A-:50)
    $blood_group_pattern = '/^([A-Z][\+\-]:\d+)(,\s*[A-Z][\+\-]:\d+)*$/';
    if (!preg_match($blood_group_pattern, $available_blood_group_no)) {
        echo "<script>alert('Invalid format for Available Blood Group No. Example: A+:50, A-:50');</script>";
        exit();
    }

    // Check if the AdminID exists in the useradmin table
    $check_admin_sql = "SELECT UserID FROM useradmin WHERE UserID = '$admin_id'";
    $check_admin_result = mysqli_query($conn, $check_admin_sql);

    if (mysqli_num_rows($check_admin_result) == 0) {
        echo "<script>alert('Error: Admin ID does not exist. Please provide a valid Admin ID.');</script>";
        exit();
    }

    // Generate a unique BankID (e.g., B101, B102)
    $prefix = 'B';
    $last_id_query = "SELECT MAX(CAST(SUBSTRING(BankID, 2) AS UNSIGNED)) AS last_id FROM BloodBank";
    $last_id_result = mysqli_query($conn, $last_id_query);
    $row = mysqli_fetch_assoc($last_id_result);
    $last_id = $row['last_id'];
    $new_id = $prefix . str_pad(($last_id + 1), 3, '0', STR_PAD_LEFT);

    // Insert query
    $sql = "INSERT INTO BloodBank (BankID, Name, Location, AdminID, AvailableBloodGroupNo)
            VALUES ('$new_id', '$name', '$location', '$admin_id', '$available_blood_group_no')";

    // Debugging: Print the SQL query
    echo "SQL Query: $sql<br>";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Blood Bank added successfully!');</script>";
        header("Location: bloodbank_list.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>