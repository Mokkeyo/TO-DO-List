<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $taskName = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_STRING);
    $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);

    if (empty($taskName) || empty($color)) {
        echo json_encode(["error" => "Task name and color are required."]);
        exit;
    }

    $sql = "INSERT INTO tasks (task_name, status, color) VALUES (?, 0, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $taskName, $color);

        if ($stmt->execute()) {
            echo json_encode(["success" => "New task created successfully"]);
        } else {
            error_log("Database Error: " . $stmt->error);
            echo json_encode(["error" => "Failed to create task. Please try again later."]);
        }

        $stmt->close();
    } else {
        error_log("Statement Preparation Error: " . $conn->error);
        echo json_encode(["error" => "Failed to prepare the SQL statement."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method."]);
}

$conn->close();
?>