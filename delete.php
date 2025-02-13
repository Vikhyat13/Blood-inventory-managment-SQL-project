<?php
include 'conn.php'; // Database connection

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    // Validate and sanitize the donor ID
    $donor_id = intval($donor_id);

    // Prepare and execute the delete query
    $sql = "DELETE FROM Donor WHERE DonorID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $donor_id); // 'i' denotes integer type
        if ($stmt->execute()) {
            // Redirect back to the donor list page after successful deletion
            header("Location: donor_list.php");
            exit; // Stop script execution after redirect
        } else {
            echo "Error: Could not delete donor.";
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare the statement.";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "No donor ID specified.";
}
?>