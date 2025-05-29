<?php
include('db.php');

// Validate the input
$taskId = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

if ($taskId === false || $status === false) {
    echo json_encode(["error" => "Invalid input."]);
    exit;
}

if ($status !== 0 && $status !== 1 && $status !== 2) {
    echo json_encode(["error" => "Invalid status."]);
    exit;
}

// Prepare the SQL statement
$sql = "UPDATE tasks SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ii", $status, $taskId);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(["success" => "Task status updated successfully"]);
    } else {
        // Log the error and return a generic error message
        error_log("Database Error: " . $stmt->error);
        echo json_encode(["error" => "Failed to update task status."]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Log the error and return a failure message
    error_log("Statement Preparation Error: " . $conn->error);
    echo json_encode(["error" => "Failed to prepare SQL statement."]);
}

// Close the connection
$conn->close();
?>