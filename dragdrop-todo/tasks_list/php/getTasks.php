<?php
include('db.php');

$status = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);

if ($status === false || $status < 0 || $status > 2) {
    $status = 0;
}

$sql = "SELECT id, task_name, color FROM tasks WHERE status = ?";
$stmt = $conn->prepare($sql);


if ($stmt === false) {
    error_log('SQL Preparation Error: ' . $conn->error);
    echo json_encode(["error" => "Internal Server Error"]);
    exit;
}

$stmt->bind_param("i", $status);

if ($stmt->execute() === false) {
    error_log('SQL Execution Error: ' . $stmt->error);
    echo json_encode(["error" => "Query Execution Failed"]);
    exit;
}

$result = $stmt->get_result();

$tasks = [];
while ($row = $result->fetch_assoc()) {
    // Ensure the task data is properly sanitized before outputting (e.g., escaping HTML special chars)
    $tasks[] = [
        'id' => $row['id'],
        'task_name' => htmlspecialchars($row['task_name'], ENT_QUOTES, 'UTF-8'),
        'color' => htmlspecialchars($row['color'], ENT_QUOTES, 'UTF-8')
    ];
}

echo json_encode($tasks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

$stmt->close();
$conn->close();
?>