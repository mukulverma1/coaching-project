<?php 
include_once("connection.php");
session_start();

$id = '';
if (isset($_GET['batch_name'])) {
    $batch_name = mysqli_real_escape_string($conn, $_GET['batch_name']);
    $sql = "SELECT `batch_id` FROM `batches` WHERE `batch_name` = '$batch_name'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['batch_id'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['studentId'])) {
    $student_id = $_POST['studentId'];
    $batch_name = $_GET['batch_name'];

    // Check if the student is already in the batch
    $check_sql = "SELECT * FROM `batch_table` WHERE `student_id` = '$student_id' AND `batch_id` = '$id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) == 0) {

        // ********************************
      $num = $_SESSION['phone_no'];
      $sql = "SELECT id FROM `teacher_data` WHERE phone_no = $num";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_assoc($result);
     $teacher_id = $row["id"];
     }

             // ********************************

        // Student is not in the batch, proceed with insertion
        $sql = "INSERT INTO `batch_table` (`student_id`,`teacher_id`, `batch_id`) VALUES ('$student_id','$teacher_id', '$id')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Redirect to the same page to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF'] . "?batch_name=" . urlencode($batch_name) . "&added=1");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Student is already in the batch
        header("Location: " . $_SERVER['PHP_SELF'] . "?batch_name=" . urlencode($batch_name) . "&error=duplicate");
        exit();
    }
}

if (isset($_POST['update'])) {
    $oldBatchName = $_POST['oldBatchName'];
    $newBatchName = $_POST['newBatchName'];

    // Sanitize inputs
    $oldBatchName = mysqli_real_escape_string($conn, $oldBatchName);
    $newBatchName = mysqli_real_escape_string($conn, $newBatchName);

    // Fetch batch ID based on old batch name
    $sql = "SELECT `batch_id` FROM `batches` WHERE `batch_name` = '$oldBatchName'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['batch_id'];

        // Update batch name
        $sqlUpdate = "UPDATE `batches` SET `batch_name`='$newBatchName' WHERE `batch_id` = '$id'";
        $updateResult = mysqli_query($conn, $sqlUpdate);

        if ($updateResult) {
            echo "<script>window.location = 'batch-dashboard.php';</script>";
            exit;  
        } else {
            die("Error in UPDATE query: " . mysqli_error($conn));
        }
    } else {
        echo "Batch not found";
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['batchName'])) {
    $batch = mysqli_real_escape_string($conn, $_POST['batchName']);

    // First, get the batch_id
    $get_batch_id_sql = "SELECT `batch_id` FROM `batches` WHERE `batch_name` = '$batch'";
    $batch_id_result = mysqli_query($conn, $get_batch_id_sql);

    if ($batch_id_result && mysqli_num_rows($batch_id_result) > 0) {
        $batch_row = mysqli_fetch_assoc($batch_id_result);
        $batch_id = $batch_row['batch_id'];

        // Start a transaction
        mysqli_begin_transaction($conn);

        try {
            // Delete students from batch_table
            $delete_students_sql = "DELETE FROM `batch_table` WHERE `batch_id` = '$batch_id'";
            $delete_students_result = mysqli_query($conn, $delete_students_sql);

            if (!$delete_students_result) {
                throw new Exception("Error deleting students from batch: " . mysqli_error($conn));
            }

            // Delete the batch from batches table
            $delete_batch_sql = "DELETE FROM `batches` WHERE `batch_name` = '$batch'";
            $delete_batch_result = mysqli_query($conn, $delete_batch_sql);

            if (!$delete_batch_result) {
                throw new Exception("Error deleting batch: " . mysqli_error($conn));
            }

            // If we've made it this far without exceptions, commit the transaction
            mysqli_commit($conn);
            echo "<script>alert('Batch and associated students deleted successfully.'); window.location = 'batch-dashboard.php';</script>";
            exit;
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            mysqli_rollback($conn);
            die("Error: " . $e->getMessage());
        }
    } else {
        die("Error: Batch not found");
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content-section {
            margin-top: 20px;
            margin-left: 310px;
        }

        .batch {
            margin-top: 2px;
            display: flex;
            justify-content: space-between;
        }

        .batch i {
            font-size: 25px;
            margin-right: 20px;
            color: black;
        }

        .batchicon {
            margin-top: -5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #DDD;
        }

        tr:hover {
            background-color: #D6EEEE;
        }

        .return {
            padding: 8px 30px;
            font-size: 25px;
            border: 1px solid black;
            text-decoration: none;
            color: black;
            border-radius: 4px;
        }

        .return:hover {
            border: 2px solid black;
        }

        .update-btn, .close-btn, .aaa {
            width: 40px;
            height: 40px;
            font-size: 25px;
            background-color: white;
            border: none;
            cursor: pointer;
            position: absolute;
            transition: all 0.25s ease;
        }

        .close-btn {
            z-index: -1;
            background-color: white;
        }

        .update-box {
            width: 0;
            height: 40px;
            padding: 0 15px;
            border-radius: 25px;
            outline: none;
            transition: width 0.25s ease;
        }

        .update {
            display: flex;
            align-items: center;
            position: relative;
        }

        .delete {
            border: none;
            background-color: transparent;
        }

        .active .update-box {
            width: 250px;
        }

        .active .update-btn {
            transform: translate(210px, 2px) scale(0.8);
            background-color: transparent;
        }

        .active .close-btn {
            margin-left: 7px;
            z-index: 0;
            transform: translate(250px, 2px);
        }

        .hidden {
            display: none;
        }

        .aaa {
            visibility: hidden;
        }

        #myBtn{
            background-color: transparent;
            font-size: 30px;
            border: none;
        }
        
        .modal {
            display: none; 
            position: fixed;
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin-top: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            color: #aaaaaa;
            padding-top: 0px;
            margin-left: 95%;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .form-container {
            display: flex;
            flex-direction: column;
        }

        .input-field {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .submit-button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #331;
        }

        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .batchname {
                margin-left: 200px;
            }

            .update {
                margin-left: 10px;
            }

            .content-section {
                margin-top: 22px;
                margin-left: 32px;
            }

            .batch i {
                margin-top: 0px;
            }
        }

        @media (max-width: 480px) {
            .batchname {
                margin-left: 100px;
            }

            .update {
                margin-left: 250px;
            }

            .content-section {
                margin-top: 15px;
                margin-left: 32px;
            }
        }
    </style>
</head>
<body>
    <?php include 'new-dash.php'; ?>

    <br>

    <div class="content-section">
        <?php
        if (isset($_GET['added']) && $_GET['added'] == '1') {
            echo '<div class="message success">Student added successfully!</div>';
        }
        if (isset($_GET['error']) && $_GET['error'] == 'duplicate') {
            echo '<div class="message error">Student is already in this batch.</div>';
        }
        ?>

        <div class="batch">
            <div class="batchname"><h2><?php echo isset($_GET['batch_name']) ? htmlspecialchars($_GET['batch_name']) : 'Batch Name'; ?></h2></div>
            <br>
            <br>
            <br>

            <div class="batchicon">
                <div class="update">
                    <form id="updateForm" action="batch-table.php" method="POST"> 
                        <input type="hidden" name="oldBatchName" value="<?php echo isset($_GET['batch_name']) ? htmlspecialchars($_GET['batch_name']) : ''; ?>">  
                        <input type="text" name="newBatchName" placeholder="Enter new name" class="update-box">
                        <button type="submit" name="update" class="aaa hidden"><i class="fa-solid fa-phone"></i></button>
                    </form>

                    <button class="update-btn"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                    <form action="batch-table.php" method="post" style="display: inline;" onsubmit="return confirmDeletion();">
                        <input type="hidden" name="batchName" value="<?php echo isset($_GET['batch_name']) ? htmlspecialchars($_GET['batch_name']) : ''; ?>">
                        <button type="submit" name="action" value="delete" class="delete" style="margin: 0 10px;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <button id="myBtn"><i class="fa-solid fa-user-plus"></i></button>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <br>
                <form class="form-container" action="?batch_name=<?php echo urlencode($_GET['batch_name']); ?>" method="POST">
                    <input class="input-field" type="number" name="studentId" placeholder="Enter Student ID" required>
                    <button class="submit-button" type="submit">ADD</button> 
                </form>
            </div>
        </div>

        <div class="table">
            <table>
                <tr>
                    <th>S.no</th>
                    <th>Unique ID</th>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                if ($id) {
                    $table = "SELECT * FROM `batch_table` b INNER JOIN `teacher_data` t ON b.student_id=t.id WHERE b.batch_id='$id'";
                    $table_data = mysqli_query($conn, $table);
                    if ($table_data === false) {
                        echo "Error: " . mysqli_error($conn);
                    } elseif (mysqli_num_rows($table_data) > 0) {
                        $sno = 1;
                        while ($row = mysqli_fetch_assoc($table_data)) {
                            echo "<tr>
                                <td>" . $sno . "</td>
                                <td>" . htmlspecialchars($row["student_id"]) . "</td>
                                <td>" .   htmlspecialchars($row["full_name"]) . "</td>
                                <td>" . htmlspecialchars($row["phone_no"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td><!-- Add action buttons here --></td>
                            </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No students found in this batch</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No batch selected or batch not found</td></tr>";
                }
                ?>
            </table>
        </div>

        <a class="return" href="student-dashboard.php">Return</a> 
    </div>

    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete this batch? This action will also remove all students associated with this batch. This action cannot be undone.");
        }

        const updateBox = document.querySelector('.update-box');
        const updateBtn = document.querySelector('.update-btn');
        const update = document.querySelector('.update');
        const closeBtn = document.querySelector('.close-btn');
        const aaaBtn = document.querySelector('.aaa');
        const updateForm = document.getElementById('updateForm');

        updateBtn.addEventListener('click', function() {
            if (update.classList.contains('active')) {
                updateBox.value = ''; // Clear the input value
                updateForm.submit(); // Submit the form
            } else {
                update.classList.add('active');
                updateBtn.classList.add('hidden'); 
                aaaBtn.classList.remove('hidden'); // Show the submit button
                updateBox.focus(); // Focus on the input box
            }
        });

        closeBtn.addEventListener('click', function() {
            update.classList.remove('active');
            updateBtn.classList.remove('hidden'); // Show the update button
            aaaBtn.classList.add('hidden'); // Hide the submit button
        });

        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Automatically hide the success/error message after 3 seconds
        setTimeout(function() {
            var messages = document.getElementsByClassName('message');
            for (var i = 0; i < messages.length; i++) {
                messages[i].style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>