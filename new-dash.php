
<?php

include_once("connection.php");

    $full_name = $_SESSION['username'];
    $sql = "SELECT * FROM `teacher_data` WHERE `full_name` = '$full_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
        $row = mysqli_fetch_array($result);
        $teacher = $row['teacher'];
        $teacher_id=$row['id'];
    }
    else {
        echo "Failed to update batch. Error: " . mysqli_error($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            
            box-sizing: border-box;
        }

        .sidebar {
            position: absolute;
            width: 290px;
            background-color: #333;
            color: #fff;
            /* color: #000; */
            min-height: 100vh;
            /* height: 200vh; */
           
            padding: 20px;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar h2 {
            margin: 0;
            font-size: 24px;
        }

        .sidebar nav ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin: 20px 0;
        }

        .sidebar nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar nav ul li a:hover {
            text-decoration: underline;
        }

        #slidebar .toggle-btn {
            position: absolute;
            top: 30px;
            left: 330px;
        }

        .toggle-btn span {
            visibility: hidden;
        }

        @media (max-width: 768px) {
            .sidebar{
                width: 200px;
                left: -220px;
                transition: .4s;
            }

            .toggle-btn span {
            width: 45px;
            height: 4px;
            background: #000;
            display: block;
            margin-top: 4px;
            visibility:visible;
        }
        #slidebar .toggle-btn{
            left: 250px;
        }

       
    }
    </style>

</head>
<body>

    <div id="slidebar" class="sidebar">
        <div class="toggle-btn" onclick="show()">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <h2>Admin Dashboard</h2>
        <nav>
            <ul>
                <li><a href="dashboard.php" id="dashboardLink">Dashboard</a></li>
                <li><a href="batch-dashboard.php" id="usersLink">Batch</a></li>
                <li><a href="#" id="usersLink">Students</a></li>
                <li><a href="teacher-profile.php?id=<?php echo urlencode($teacher_id); ?>" id="reviewsLink">Reviews</a></li>   
                <?php 
                
                if($teacher == "No"){
                 echo '<li><a href="registration-form.php" id="registrationLink">Register as a teacher</a></li>';
                }
                
                ?>
                <li><a href="index.php" id="exit">Exit</a></li>
            </ul>
        </nav>
    </div>
</body>
<script>
    function show() {
        document.getElementById('slidebar').classList.toggle('active');
    }
</script>
</html>
