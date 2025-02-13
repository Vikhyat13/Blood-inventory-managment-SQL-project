<?php
include 'conn.php'; // Database connection

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $que_id = $_GET['id'];

    // Validate and sanitize the query ID
    $que_id = intval($que_id);

    // Prepare and execute the delete query
    $sql = "DELETE FROM contact_query WHERE QueryID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $que_id); // 'i' denotes integer type
        if ($stmt->execute()) {
            // Redirect back to the query page after successful deletion
            header("Location: query.php");
            exit; // Stop script execution after redirect
        } else {
            echo "Error: Could not delete query.";
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare the statement.";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "No query ID specified.";
}
?>