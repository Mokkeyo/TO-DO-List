<?php
include('db.php');

// Validate inputs
$taskId = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$taskName = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);

if ($taskId === false || empty($taskName) || empty($color)) {
    echo json_encode(["error" => "Invalid input. Please make sure all fields are filled correctly."]);
    exit;
}

$sql = "UPDATE tasks SET task_name = ?, color = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $taskName, $color, $taskId);


    if ($stmt->execute()) {
        echo json_encode(["success" => "Task updated successfully"]);
    } else {
        error_log("Database Error: " . $stmt->error);
        echo json_encode(["error" => "Failed to update task. Please try again later."]);
    }

    $stmt->close();
} else {
    error_log("Statement Preparation Error: " . $conn->error);
    echo json_encode(["error" => "Failed to prepare SQL statement."]);
}

$conn->close();
?>