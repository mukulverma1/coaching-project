<?php
require_once 'connection.php';
include_once 'navbar.php';

if (isset($_GET['id'])) {
    $teacher_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM teacher_data WHERE id = ?");
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $teacher = $result->fetch_assoc();
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

        body {
            margin-top: 5.5rem;
            font-family: Arial, sans-serif;
            background-color: ghostwhite;
        }

        .teacher {
            margin: 0 auto;
            padding: 20px;

            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 2rem auto;
            gap: 2rem;
        }

        .teacher-info {
            flex: 1;
            min-width: 300px;
            /* max-width: 400px; */
            background-color: goldenrod;
            border-radius: 1rem;
            border: #212121 0.2rem solid;
            transition: all 0.4s ease-in;
            box-shadow: 0.4rem 0.4rem 0.6rem #00000040;
            padding: 1rem;
            /*  */
            height: fit-content;
        }

        .teacher-info:hover {
            transform: translateY(-0.5rem);
            border: #2b926cf0 0.2em solid;
            border-radius: 2.5rem 0 2.5rem 0;
        }

        .teacher-info img {
            width: 100%;
            height: auto;
            /*  */
            height: 300px;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10%;
            margin-bottom: 1rem;
        }

        .teacher-info .rating span {
            font-size: 1.2rem;
        }

        .teacher-info span {
            display: block;
            margin-top: 0.5rem;
            color: black;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .social-media {
            margin-top: 1rem;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f2f2f2;
            box-shadow: 0px 0px 15px #00000027;
            padding: 15px 10px;
            border-radius: 5em;
        }

        .social-button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 39px;
            height: 39px;
            border-radius: 50%;
            margin: 0 10px;
            background-color: #fff;
            box-shadow: 0px 0px 4px #00000027;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-button:hover {
            background-color: #f2f2f2;
            box-shadow: 0px 0px 6px 3px #00000027;
        }

        .social-buttons i {
            transition: 0.3s;
            font-size: 20px;
        }

        .facebook { background-color: #3b5998; }
        .facebook i { color: #f2f2f2; }
        .facebook:hover i { color: #3b5998; }

        .github { background-color: #333; }
        .github i { color: #f2f2f2; }
        .github:hover i { color: #333; }

        .linkedin { background-color: #0077b5; }
        .linkedin i { color: #f2f2f2; }
        .linkedin:hover i { color: #0077b5; }

        .instagram { background-color: #c13584; }
        .instagram i { color: #f2f2f2; }
        .instagram:hover i { color: #c13584; }

        .info {
            flex: 2;
            min-width: 300px;
        }

        .location h2,
        .about h2,
        .review h2 {
            font-size: 1.8rem;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin-bottom: 1rem;
        }

        .location span {
            font-size: 1.2rem;
            display: block;
            margin-bottom: 0.5rem;
        }

        .location span i {
            margin-right: 10px;
        }

        .about,
        .review {
            margin-top: 2rem;
        }

        .about p,
        .review p {
            font-size: 1rem;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .teacher {
                flex-direction: column;
                align-items: center;
            }

            .teacher-info,
            .info {
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="teacher">
        <div class="teacher-info">
            <img src="<?php echo $teacher['destfile']; ?>" alt="<?php echo $teacher['full_name']; ?>">
            <span><?php echo $teacher['full_name']; ?></span>
            <div class="rating">
                <span class="fa fa-star checked"></span>
                <span>5 <a href="">( 13 reviews )</a></span>
            </div>
            <span>Experience: <?php echo $teacher['experience_yy']; ?> Years <?php echo $teacher['experience_mm']; ?> Months</span>
            <span>Qualification: <?php echo $teacher['qualification']; ?></span>
            <span>Subjects: <?php echo $teacher['subjects']; ?></span>

            <div class="social-media">
                <div class="social-buttons">
                    <a href="#" class="social-button github">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="social-button linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-button facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-button instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="info">
            <div class="location">
                <h2>Class location</h2>
                <span><i class="fa-solid fa-location-dot"></i><?php echo $teacher['coachingaddress']; ?></span>
            </div>

            <div class="about">
                <h2>About <?php echo $teacher['full_name']; ?></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, minus rerum. Quo tempore, vel alias iure labore iste voluptatibus quaerat reprehenderit et, veritatis qui voluptas? Doloribus tenetur, quaerat eaque voluptate numquam magnam dolorum totam voluptates ipsam reprehenderit dolor voluptatum? Perspiciatis, eveniet officiis.</p>
            </div>

            <!-- <div class="review">
                <h2>Review</h2>
                <div class="review-user">
                    <h3>Name</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis, nam?</p>
                </div>
            </div> -->
            <br>
            <br>

            <h2>Comments</h2>

            <?php include_once 'previous-comment.php'; ?>

            <?php include_once 'review.php'; ?>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
</body>
</html>
<?php
    } else {
        echo "Teacher not found.";
    }
} else {
    echo "No teacher ID provided.";
}
?>