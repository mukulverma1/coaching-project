<?php
require_once 'connection.php';

// Pagination logic
$limit = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM teacher_data LIMIT $offset, $limit";
$res = mysqli_query($conn, $sql);

if ($res === false) {
    echo "Error: " . $conn->error;
    exit;
}

$total_sql = "SELECT COUNT(*) FROM teacher_data";
$total_res = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_array($total_res)[0];
$total_page = ceil($total_row / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Browser</title>
  
  <style>
    .grid-container {
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
      /* width: 100%; */
      border-radius: 10px;
      border: 2px solid #c3c6ce;
      transition: 0.5s ease-out;
      overflow: hidden;
      text-align: center;
      height: auto;
    }

    #rating {
      /* display: flex; */
      align-items: center;
      /* font-size: 14px; */
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
      /* background-color: #008bf8; */
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
      font-size: 28px;
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

    .grid-container a{
      text-decoration: none;
    }

    .grid-container p{
      color: black;
    }

    .pagination {
            display: flex;
            justify-content: center;
            list-style-type: none;
            margin-top: 30px;
        }

        .pagination a {
            color: #2c3e50;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #3498db;
            color: white;
            border: 1px solid #3498db;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

    @media (max-width: 768px)
    {
      .grid-container {
        grid-gap: 10px;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));

    }
    }

  </style>

</head>

<body>

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

  <div class="pagination">
    <a href="?page=1">First</a>
    <?php for($i = 1; $i <= $total_page; $i++): ?>
        <a class="<?php echo $i == $page ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
    <a href="<?php echo $page == $total_page ? '#' : '?page='.($page + 1); ?>">Next</a>
    <a href="?page=<?php echo $total_page; ?>">Last</a>
  </div>

</body>

</html>