<?php
include_once("connection.php");
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get parameters from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Record ID
$batchName = isset($_GET['batch_name']) ? $conn->real_escape_string($_GET['batch_name']) : ''; // Batch name to delete

// Validate inputs
if ($id <= 0 || empty($batchName)) {
    die('Invalid parameters');
}

// Fetch the current serialized array from the database
$sql = "SELECT `groups` FROM `teacher_data` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $existingGroups = $row['groups'];
    $allGroups = array_map('trim', explode(',', $existingGroups));

    // Check if the batch name exists in the array and remove it
    if (($key = array_search($batchName, $allGroups)) !== false) {
        unset($allGroups[$key]);
        // Convert array back to string
        $updatedGroups = implode(',', array_values($allGroups));

        // Update database
        $updateSql = "UPDATE `teacher_data` SET `groups` = '$updatedGroups' WHERE `id` = $id";
        if (mysqli_query($conn, $updateSql)) {
            echo 'Batch deleted successfully';
        } else {
            echo 'Failed to delete batch. Error: ' . mysqli_error($conn);
        }
    } else {
        echo 'Batch name not found in the array.';
    }
} else {
    die('Record not found');
}

// Close the database connection
mysqli_close($conn);
?>
