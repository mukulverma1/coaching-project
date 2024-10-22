<?php 
session_start();

include_once 'connection.php';
$num = $_SESSION['phone_no'];

$sanitized_num = mysqli_real_escape_string($conn, $num);

$sql = "SELECT id FROM `teacher_data` WHERE phone_no = '$sanitized_num'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    echo "Error: " . $conn->error;
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $teacher_id = $row["id"];
} else {
    echo "No teacher found for this phone number.";
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;

}

.main-content {
    flex: 1;
    padding: 20px;  
    margin-left: 280px;
}

header {
    background-color: #f4f4f4;
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
}

header h1 {
    margin: 0;
}

.content-section {
    margin-top: 20px;
}

.stats {
    display: flex;
    justify-content: space-around;
}

.stat {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    width: 200px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #f4f4f4;
}

button {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #0056b3;
}


@media (max-width: 768px) {
          
    .main-content{
        margin-top: 20px;
        margin-left: 0px;
    }
            

        }
        @media (max-width: 480px) {
            .main-content{
                margin-top: 20px;
                margin-left: 0px;
    }
        }

    </style>

</head>
<body>

    <?php include 'new-dash.php'; ?>

    <br>
    <br>

    <div class="main-content">
        <header>
            <h1>Welcome, <?php echo $_SESSION['username'] ?></h1>
        </header>
        <section id="dashboard" class="content-section">
            <h2>Dashboard Overview</h2>
            <div class="stats">
                <div class="stat">
                    <h3>Total Students</h3>
                    <p id="totalUsers">0</p>
                </div>
                <div class="stat">
                    <h3>Total Reviews</h3>
                    <p id="totalReviews">0</p>
                </div>
            </div>
        </section>
        <section id="users" class="content-section" style="display:none;">
            <!-- <h2>Student Management</h2> -->
            <table>
                <!-- <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                        <th>Actions</th>
                    </tr>
                </thead> -->
                <tbody id="usersTableBody">
                    <!-- User rows will be added here by JavaScript -->
                </tbody>
            </table>
        </section>
        <section id="reviews" class="content-section" style="display:none;">
        <h2>Review Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Teacher</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="reviewsTableBody">
                    <!-- Review rows will be added here by JavaScript -->
                   
                </tbody>
            </table>
        </section>
    </div>
    <script>
        // dashboard.js

document.addEventListener('DOMContentLoaded', () => {
    const dashboardLink = document.getElementById('dashboardLink');
    const usersLink = document.getElementById('usersLink');
    const reviewsLink = document.getElementById('reviewsLink');

    const dashboardSection = document.getElementById('dashboard');
    const usersSection = document.getElementById('users');
    const reviewsSection = document.getElementById('reviews');

    dashboardLink.addEventListener('click', () => {
        dashboardSection.style.display = 'block';
        usersSection.style.display = 'none';
        reviewsSection.style.display = 'none';
    });

    usersLink.addEventListener('click', () => {
        dashboardSection.style.display = 'none';
        usersSection.style.display = 'block';
        reviewsSection.style.display = 'none';
    });

    reviewsLink.addEventListener('click', () => {
        dashboardSection.style.display = 'none';
        usersSection.style.display = 'none';
        reviewsSection.style.display = 'block';
    });

    // Example data for users and reviews
    // const users = [
    //     { id: 1, name: 'Alice Johnson', email: 'alice@example.com' },
    //     { id: 2, name: 'Bob Smith', email: 'bob@example.com' },
    // ];

    // const reviews = [
    //     { id: 1, teacher: 'John Doe', rating: 5, review: 'Great teacher!' },
    //     { id: 2, teacher: 'Jane Doe', rating: 4, review: 'Very helpful.' },
    // ];

    // const usersTableBody = document.getElementById('usersTableBody');
    // const reviewsTableBody = document.getElementById('reviewsTableBody');

    // users.forEach(user => {
    //     const row = document.createElement('tr');
    //     row.innerHTML = `
    //         <td>${user.id}</td>
    //         <td>${user.name}</td>
    //         <td>${user.email}</td>
    //         <td><button>Delete</button></td>
    //     `;
    //     usersTableBody.appendChild(row);
    // });

    // reviews.forEach(review => {
    //     const row = document.createElement('tr');
    //     row.innerHTML = `
    //         <td>${review.id}</td>
    //         <td>${review.teacher}</td>
    //         <td>${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}</td>
    //         <td>${review.review}</td>
    //         <td><button>Delete</button></td>
    //     `;
    //     reviewsTableBody.appendChild(row);
    // });

    // Initialize with dashboard view
    dashboardSection.style.display = 'block';
    usersSection.style.display = 'none';
    reviewsSection.style.display = 'none';
});

    </script>
</body>
</html>
