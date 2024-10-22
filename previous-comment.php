<?php
include_once 'connection.php';

$sql = "SELECT teacher.id, teacher.destfile, teacher.full_name, comment.reviewed_id, comment.comment, comment.star_rating
        FROM teacher_data teacher
        JOIN comments comment ON teacher.id = comment.reviewed_id";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attractive Comments Section with Stars</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .previous-comment {
            margin-top: 9px;
        }

        .comment-section {
            border-bottom: 1px solid black;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 1000px;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .profile h2 {
            font-size: 18px;
            color: #1c1e21;
        }

        .star-rating {
            margin-bottom: 15px;
        }

        .star-rating label {
            font-size: 30px;
            color: #ddd;
        }

        .star-rating input:checked ~ label {
            color: #ffc107;
        }

        .comment-input {
            font-size: 16px;
            color: #1c1e21;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="previous-comment">
    <?php 
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $stars = $row['star_rating'];
            $filledStars = str_repeat('★', $stars);  
            $emptyStars = str_repeat('★', 5 - $stars);
            ?>
            
            <section class="comment-section">
                <div class="profile">
                    <img src="<?php echo $row['destfile']; ?>" alt="User profile">
                    <h2><?php echo $row['full_name']; ?></h2>
                </div>

                <div class="star-rating">
                    <?php echo '<span style="color: #ffc107;">' . $filledStars . '</span>'; ?>
                    <?php echo '<span style="color: #ddd;">' . $emptyStars . '</span>'; ?>
                </div>

                <p class="comment-input"><?php echo $row['comment']; ?></p>
            </section>

            <?php
        }
    } else {
        echo "No comments found.";
    }
    ?>
</div>

</body>
</html>
