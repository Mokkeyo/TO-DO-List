<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['task_id'])) {
    $taskId = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);

    if ($taskId === false) {
        echo json_encode(["error" => "Invalid task ID"]);
        exit;
    }

    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $taskId);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Task deleted successfully"]);
        } else {
            error_log("Database Error: " . $stmt->error);
            echo json_encode(["error" => "Failed to delete task. Please try again later."]);
        }

        $stmt->close();
    } else {
        error_log("Statement Preparation Error: " . $conn->error);
        echo json_encode(["error" => "Failed to prepare the SQL statement."]);
    }
} else {
    echo json_encode(["error" => "Invalid request or missing task ID"]);
}

$conn->close();
?>