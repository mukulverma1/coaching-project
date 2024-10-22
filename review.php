<?php
include_once 'connection.php'; 

$teacher_id = $_GET['id'];
$message = '';

$user_image = 'https://via.placeholder.com/40';

if (isset($_POST['submit'])) { 
    if (isset($_SESSION['phone_no'])) {
        $comment = $_POST['comment']; 
        $star_rating = $_POST['star_rating'];
        $phone_no = $_SESSION['phone_no'];

        $sql = "SELECT * FROM teacher_data WHERE phone_no = '$phone_no'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) { 
            $row = mysqli_fetch_assoc($result);
            $reviewed_id = $row['id'];

            $user_image = $row['destfile'];


            $send_data = "INSERT INTO `comments`(`teacher_id`, `reviewed_id`, `comment`, `star_rating`) 
                          VALUES ('$teacher_id', '$reviewed_id', '$comment', '$star_rating')";

            if (mysqli_query($conn, $send_data)) {
                $message = "Review added successfully.";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        } else {
            $message = "User not found in the database.";
        }
    } else {
        $message = "Please login first!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
      
            /* max-width: 600px; */
            /* margin: 0 auto;
            padding: 20px; */
            font-family: Arial, sans-serif;
            background-color: ghostwhite;
        }

        .review-form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 20px;
        }

        .product {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .product img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 15px;
        }

        .stars {
            color: #ffd700;
            font-size: 24px;
            margin-bottom: 10px;
        }

        textarea {
            width: 95%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
        }

        .min-words {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }

        .reviewer {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .reviewer img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .buttons {
            margin-top: 20px;
            text-align: right;
        }

        .post-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .cancel-button {
            background-color: #f5f5f5;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .popup-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        i {
            color: gray;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php if ($message): ?>
<div class="popup">
    <div class="popup-content">
        <p><?php echo $message; ?></p>
        <button class="popup-button" onclick="this.parentElement.parentElement.style.display='none';">Close</button>
    </div>
</div>
<?php endif; ?>

<div class="review">
    <div class="review-form">
        <h1>Write a Review</h1>

        <div class="product">
            <div>
                <i class="fa-solid fa-star" data-star="1"></i>
                <i class="fa-solid fa-star" data-star="2"></i>
                <i class="fa-solid fa-star" data-star="3"></i>
                <i class="fa-solid fa-star" data-star="4"></i>
                <i class="fa-solid fa-star" data-star="5"></i>
            </div>
        </div>

        <form action="" method="post" id="reviewForm">
            <input type="hidden" name="star_rating" id="star_rating" value="0">
            <textarea placeholder="Write a review for teacher" name="comment"></textarea>

            <p class="min-words">Minimum of 15 words.</p>

            <div class="reviewer">
            <img src="<?php echo $user_image; ?>" alt="Reviewer">
    <span>Reviewed by</span>
    <span>_</span>
    <span><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'unknown'; ?></span>
</div>

            <div class="buttons">
                <button class="cancel-button" type="button">Cancel</button>
                <button class="post-button" type="submit" name="submit" value="submit">Post Your Review</button>
            </div>
        </form>
    </div>
</div>

<script>
    const stars = document.querySelectorAll('.fa-star');
    let currentRating = 0;
    const starRatingInput = document.getElementById('star_rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {               
            const clickedRating = parseInt(star.getAttribute('data-star'));

            if (clickedRating === currentRating) {
                stars.forEach(s => s.style.color = 'gray');
                currentRating = 0;
            } else {
                stars.forEach(s => {
                    const starRating = parseInt(s.getAttribute('data-star'));
                    s.style.color = starRating <= clickedRating ? 'orange' : 'gray';
                });
                currentRating = clickedRating;
            }

            starRatingInput.value = currentRating;
        });
    });

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    <?php if ($message && strpos($message, 'successfully') !== false): ?>
    document.getElementById('reviewForm').reset();
    stars.forEach(s => s.style.color = 'gray');
    currentRating = 0;
    starRatingInput.value = 0;
    <?php endif; ?>
</script>
</body>
</html>
