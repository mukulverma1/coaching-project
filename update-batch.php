<?php
include_once("connection.php");
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Updates a batch name in the database.
 *
 * @param string $old_name The current name of the batch.
 * @param string $new_name The new name to replace the old batch name.
 * @return string|null Error message or null if successful.
 */
function updateBatchName($old_name, $new_name) {
    global $conn;
    $full_name = mysqli_real_escape_string($conn, $_SESSION['username']);
    
    // Debug output for verification
    echo 'Full name: ' . $full_name . '<br>';
    echo 'Old batch name: ' . $old_name . '<br>';
    echo 'New batch name: ' . $new_name . '<br>';

    // Fetch existing data
    $sql = "SELECT `groups` FROM `teacher_data` WHERE `full_name` = '$full_name'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $existingGroups = $row['groups'];
            $allGroups = array_map('trim', explode(',', $existingGroups));

            // Debug: Print the fetched groups
            echo 'Fetched groups: ' . implode(', ', $allGroups) . '<br>';

            // Update batch name
            $index = array_search($old_name, $allGroups);
            if ($index !== false) {
                // Only update if the new name is different from the old name
                if ($allGroups[$index] !== $new_name) {
                    $allGroups[$index] = $new_name;
                }
            } else {
                return "Batch name '$old_name' not found.";
            }

            // Convert array back to string
            $updatedGroups = implode(',', $allGroups);

            // Update database with merged data
            $updateSql = "UPDATE `teacher_data` SET `groups` = '$updatedGroups' WHERE `full_name` = '$full_name'";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                return $new_name; // Return new name for redirection
            } else {
                return "Failed to update batch. Error: " . mysqli_error($conn);
            }
        } else {
            return "No data found for the user.";
        }
    } else {
        return "Failed to fetch existing data. Error: " . mysqli_error($conn);
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (isset($_POST['oldBatchName']) && isset($_POST['newBatchName'])) {
        $old_name = trim($_POST['oldBatchName']);
        $new_name = trim($_POST['newBatchName']);

        $result = updateBatchName($old_name, $new_name);

        if (is_string($result)) {
            echo $result; // Output any error message
        } else {
            // Redirect to the batch-table.php with new batch name
            header("Location: batch-table.php?batch_name=$result");
            exit();
        }
    } else {
        echo "Required fields missing.";
    }
}
?>
