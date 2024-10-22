<?php
require_once 'connection.php';
require_once 'navbar.php';

$name = isset($_POST['search']) ? $_POST['search'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : ''; // ID field

$sql = "SELECT * FROM teacher_data WHERE 1=1";

if (!empty($name)) {
    $sql .= " AND (full_name LIKE '%$name%' OR subjects LIKE '%$name%' OR city LIKE '%$name%')";
}

if (!empty($subject)) {
    $sql .= " AND subjects LIKE '%$subject%'";
}

if (!empty($city)) {
    $sql .= " AND city LIKE '%$city%'";
}

if (!empty($id)) {
    $sql .= " AND id = '$id'";
}

$res = mysqli_query($conn, $sql);

if ($res === false) {
    echo "Error: " . $conn->error;
    exit;
}

// Fetch unique subjects and cities for filter options
$subjectsQuery = "SELECT DISTINCT subjects FROM teacher_data";
$subjectsResult = mysqli_query($conn, $subjectsQuery);

$citiesQuery = "SELECT DISTINCT city FROM teacher_data";
$citiesResult = mysqli_query($conn, $citiesQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Browser</title>
  
  <style>
    .grid-container {
        /* margin-top: .5rem; */
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      grid-gap: 20px;
      padding: 20px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    img {
      width: 100%;
      object-fit: fill;
    }

    .n,
    #rating {
      font-size: 18px;
    }

    .card {
      position: relative;
      border-radius: 10px;
      border: 2px solid #c3c6ce;
      transition: 0.5s ease-out;
      overflow: hidden;
      text-align: center;
      height: auto;
    }

    #rating {
      align-items: center;
      color: #fea116;
    }

    #rating::before {
      content: '★';
      margin-right: 5px;
    }

    .card-button {
      width: 60%;
      border-radius: 1rem;
      border: none;
      background-color: gold;
      color: #fff;
      font-size: 1rem;
      padding: 0.5rem 1rem;
      margin-top: 4px;
      cursor: pointer;
      transition: opacity 0.3s ease-out;
      opacity: 0;
      overflow: visible;
    }

    .text-title {
      font-size: 1.8em;
      margin-bottom: 10px;
    }

    .card:hover {
      border-color: gold;
      box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
      transition: .3s;
    }
    
    .card:hover .card-button {
      opacity: 1;
      margin-bottom: 10px;
    }

    .grid-container a {
      text-decoration: none;
    }

    .grid-container p {
      color: black;
    }

    @media (max-width: 768px) {
      .grid-container {
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      }
    }

    /* Styles for the filter section */
    .filter-section {
      margin-top: 5rem;
      padding: 20px;
      background-color: #f0f0f0;
      border-radius: 10px;
    }

    .filter-form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .filter-form select, .filter-form input[type="text"], .filter-form input[type="submit"] {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .filter-form input[type="submit"] {
      background-color: gold;
      color: #fff;
      cursor: pointer;
    }

    .filter-form input[type="submit"]:hover {
      background-color: #ffd700;
    }

  </style>

</head>

<body>

  <!-- Filter section with ID field -->
  <div class="filter-section">
    <form class="filter-form" method="POST" action="">
      <input type="text" name="search" placeholder="Search by name, subject, or city" value="<?php echo htmlspecialchars($name); ?>">
      <input type="text" name="id" placeholder="Search by ID" value="<?php echo htmlspecialchars($id); ?>">
      <select name="subject">
        <option value="">All Subjects</option>
        <!-- <option value="">punjabi</option> -->
        <?php while($subjectRow = mysqli_fetch_assoc($subjectsResult)): ?>
      
          <option value="<?php echo htmlspecialchars($subjectRow['subjects']); ?>" <?php echo ($subject == $subjectRow['subjects']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($subjectRow['subjects']); ?>
          </option>
        <?php endwhile; ?>
      </select>
      <select name="city">
        <option value="">All Cities</option>
        <?php while($cityRow = mysqli_fetch_assoc($citiesResult)): ?>
          <option value="<?php echo htmlspecialchars($cityRow['city']); ?>" <?php echo ($city == $cityRow['city']) ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($cityRow['city']); ?>
          </option>
        <?php endwhile; ?>
      </select>
      <input type="submit" value="Apply Filters">
    </form>
  </div>


  <div class="grid-container">
    <?php while($row = mysqli_fetch_assoc($res)): ?>
      <div class="card">
        <a href="teacher-profile.php?id=<?php echo urlencode($row['id']); ?>">
          <img src="<?php echo htmlspecialchars($row["destfile"]); ?>" alt="<?php echo htmlspecialchars($row["full_name"]); ?>" class="card-img">
          <div>
            <p class="text-title"><?php echo htmlspecialchars($row["full_name"]); ?></p>
            <p class="n">Subjects: <?php echo htmlspecialchars($row["subjects"]); ?></p>
            <p class="n">Qualification: <?php echo htmlspecialchars($row["qualification"]); ?></p>
            <p class="n">Experience: <?php echo htmlspecialchars($row["experience_yy"]); ?></p>
            <p class="n" id="rating">Rating: <?php echo htmlspecialchars($row["rating"]); ?></p>
          </div>
          <button class="card-button">More info</button>
        </a>
      </div>
    <?php endwhile; ?>
  </div>


  <?php require_once 'footer.php'; ?>

</body>

</html>