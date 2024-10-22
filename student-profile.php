<?php
require_once 'connection.php';
include_once 'navbar.php';

$sql = "SELECT * FROM `teacher_data` WHERE full_name = '{$_SESSION['username']}' AND phone_no = '{$_SESSION['phone_no']}'";
$result = mysqli_query($conn, $sql);

if (!mysqli_num_rows($result)) {
    echo "No data found!";
} else {
    $row = mysqli_fetch_assoc($result);    
}
?>

<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);

    $sql = "UPDATE teacher_data SET 
            email = '$email', 
            phone_no = '$phone', 
            state = '$state', 
            city = '$city', 
            pincode = '$pincode', 
            address = '$address', 
            dob = '$dob', 
            qualification = '$qualification', 
            `school/college` = '$school' 
            WHERE full_name = '{$_SESSION['username']}' AND phone_no = '{$_SESSION['phone_no']}'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['phone_no'] = $phone; // Update the session with the new phone number
        // header("Location: teacher_profile.php?update=success");  
        
    } else {
        // header("Location: teacher_profile.php?update=error");
    }
} else {
    header("Location: teacher_profile.php");
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .student-profile {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 95vh;
            background-color: ghostwhite;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 3rem;
        }
        .profile-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 2rem;
            max-width: 64rem;
            width: 100%;
            transition: transform 0.3s ease;
        }
        .profile-card:hover {
            /* transform: translateY(-5px); */
        }
        .profile-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .avatar {
            width: 12rem;
            height: 12rem;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .avatar:hover {
            transform: scale(1.05);
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-name {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 1rem;
            color: #2d3748;
        }
        .profile-id {
            font-size: 1.25rem;
            color: #4a5568;
        }
        .profile-form {
            display: grid;
            gap: 1rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #4a5568;
        }
        input {
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        input:disabled {
            background-color: transparent;
            color: #4a5568;
        }
        input:not(:disabled) {
            background-color: #ebf8ff;
            border-color: #4299e1;
        }
        input:not(:disabled):focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }
        .batches {
            margin-top: 2rem;
        }
        .batches span {
            margin: 1rem;
            padding: .7rem;
            font-size: large;
            border: 2px solid gold;
            border-radius: 25%;
        }
        .button {
            background-color: #4299e1;
            color: white;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #3182ce;
            transform: translateY(-2px);
        }
        .button-group {
            display: flex;
            gap: 1rem;
        }
        .button-group .button {
            flex: 1;
        }
        .edit-icon {
            position: absolute;
            top: 5rem;
            right: 2rem;
            font-size: 1.5rem;
            cursor: pointer;
            background: none;
            border: none;
            color: #4a5568;
            transition: all 0.3s ease;
        }
        .edit-icon:hover {
            color: #2d3748;
            transform: rotate(15deg);
        }

        @media (min-width: 768px) {
            .edit-icon {
                top: 5.9rem;
                right: 16rem;
            }
            .profile-content {
                flex-direction: row;
            }
            .profile-header {
                flex: 0 0 auto;
                margin-right: 2rem;
            }
            .profile-form {
                flex: 1;
                grid-template-columns: repeat(2, 1fr);
            }
            .form-group.full-width {
                grid-column: span 2;
            }
        }
    </style>
</head>
<body>
    <div class="student-profile">
        <div class="profile-card">
            <div class="profile-content">
                <div class="profile-header">
                    <div class="avatar">
                        <img src="<?php echo $row['destfile'];?>" alt="Teacher">
                    </div>
                    <h1 class="profile-name"><?php echo $_SESSION['username']; ?></h1>
                    <h2 class="profile-id">Teacher ID: <?php echo $row['id']; ?></h2>
                </div>
                <form id="profileForm" class="profile-form" method="post" action="student-profile.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" value="<?php echo $_SESSION['username']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" value="<?php echo $row['email']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone No</label>
                        <input id="phone" name="phone" type="tel" value="<?php echo $row['phone_no']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input id="state" name="state" type="text" value="<?php echo $row['state']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input id="city" name="city" type="text" value="<?php echo $row['city']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input id="pincode" name="pincode" type="text" value="<?php echo $row['pincode']; ?>" disabled>
                    </div>
                    <div class="form-group full-width">
                        <label for="address">Address</label>
                        <input id="address" name="address" type="text" value="<?php echo $row['address']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input id="dob" name="dob" type="date" value="<?php echo $row['dob']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input id="qualification" name="qualification" type="text" value="<?php echo $row['qualification']; ?>" disabled>
                    </div>
                    <div class="form-group full-width">
                        <label for="school">College/School Name</label>
                        <input id="school" name="school" type="text" value="<?php echo $row['school/college']; ?>" disabled>
                    </div>

                    <button type="button" id="editButton" class="edit-icon" aria-label="Edit profile"><i class="fa-solid fa-pen-to-square"></i></button>
                    <div class="form-group full-width">
                        <div class="button-group">
                            <button type="submit" id="updateButton" class="button" style="display: none;">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('profileForm');
            const editButton = document.getElementById('editButton');
            const updateButton = document.getElementById('updateButton');
            const inputs = form.querySelectorAll('input');

            editButton.addEventListener('click', function() {
                inputs.forEach(input => {
                    input.disabled = false;
                });
                updateButton.style.display = 'block';
            });
        });
    </script>

    <?php include_once 'footer.php'; ?>
</body>
</html>