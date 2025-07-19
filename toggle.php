<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $result = $conn->query("SELECT status FROM users WHERE id = $id");

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $new_status = $row["status"] == 1 ? 0 : 1;
        $conn->query("UPDATE users SET status = $new_status WHERE id = $id");
        echo json_encode(["success" => true, "new_status" => $new_status]);
        exit;
    }
}

echo json_encode(["success" => false]);
