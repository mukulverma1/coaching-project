<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Attractive Responsive Navbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /* background-color: #f0f2f5; */
            /* background-color: white; */
        }

        nav {
            background: linear-gradient(135deg, #3a6186, #89253e);
            /* background: white; */
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            padding: 0 100px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        nav .logo {
            color: #fff;
            font-size: 30px;
            font-weight: 600;
            letter-spacing: -1px;
        }

        nav .nav-items {
            display: flex;
            flex: 1;
            padding: 0 0 0 40px;
        }

        nav .nav-items li {
            list-style: none;
            padding: 0 15px;
        }

        nav .nav-items li a {
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav .nav-items li a:hover {
            color: #ffd700;
        }

        nav form {
            display: flex;
            height: 40px;
            padding: 2px;
            background: rgba(255,255,255,0.2);
            min-width: 18%!important;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        nav form .search-data {
            width: 100%;
            height: 100%;
            padding: 0 10px;
            color: #fff;
            font-size: 17px;
            border: none;
            font-weight: 500;
            background: none;
        }

        nav form .search-data::placeholder {
            color: rgba(255,255,255,0.7);
        }

        nav form button {
            padding: 0 15px;
            color: #fff;
            font-size: 17px;
            background: #ffd700;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        nav form button:hover {
            background: #e6c300;
        }

        nav .menu-icon,
        nav .cancel-icon,
        nav .search-icon,
        nav .profile-icon {
            width: 40px;
            text-align: center;
            margin: 0 50px;
            font-size: 18px;
            color: #fff;
            cursor: pointer;
            display: none;
        }

        nav .profile-icon {
            display: block;
        }

        nav .profile-menu {
            position: absolute;
            top: 70px;
            right: 100px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            display: none;
            overflow: hidden;
            margin-right: 300px;
        }

        nav .profile-menu.active {
            display: block;
        }

        nav .profile-menu ul {
            list-style: none;
        }

        nav .profile-menu ul li {
            padding: 10px 20px;
            transition: background 0.3s ease;
        }

        nav .profile-menu ul li a {
            color: #333;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
        }

        nav .profile-menu ul li:hover {
            background: #f0f2f5;
        }

        nav .profile-menu ul li a:hover {
            color: #89253e;
        }

        @media (max-width: 1245px) {
            nav {
                padding: 0 50px;
            }
            nav .profile-menu {
                right: 50px;
            }
        }

        @media (max-width: 1140px) {
            nav {
                padding: 0px;
            }
            nav .logo {
                flex: 2;
                text-align: center;
            }
            nav .nav-items {
                position: fixed;
                z-index: 99;
                top: 70px;
                width: 100%;
                left: -100%;
                height: 100%;
                padding: 10px 50px 0 50px;
                text-align: center;
                background: #3a6186;
                display: inline-block;
                transition: left 0.3s ease;
            }
            nav .nav-items.active {
                left: 0px;
            }
            nav .nav-items li {
                line-height: 40px;
                margin: 30px 0;
            }
            nav .nav-items li a {
                font-size: 20px;
            }
            nav form {
                position: absolute;
                top: 80px;
                right: 50px;
                opacity: 0;
                pointer-events: none;
                transition: top 0.3s ease, opacity 0.1s ease;
                background-color: currentcolor;
            }
            nav form.active {
                top: 95px;
                opacity: 1;
                pointer-events: auto;
            }
            nav .menu-icon {
                display: block;
            }
            nav .search-icon,
            nav .menu-icon span {
                display: block;
            }
            nav .menu-icon span.hide,
            nav .search-icon.hide {
                display: none;
            }
            nav .cancel-icon.show {
                display: block;
            }
            nav .profile-menu {
                right: 30px;
            }
        }

        @media (max-width: 980px) {
            nav .menu-icon,
            nav .cancel-icon,
            nav .search-icon,
            nav .profile-icon {
                margin: 0 20px;
            }
            nav form {
                right: 30px;
            }
        }

        @media (max-width: 350px) {
            nav .menu-icon,
            nav .cancel-icon,
            nav .search-icon,
            nav .profile-icon {
                margin: 0 10px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="menu-icon">
            <span class="fas fa-bars"></span>
        </div>
        <div class="logo">
            Logo
        </div>
        <div class="nav-items">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Blogs</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Feedback</a></li>
        </div>
        <div class="search-icon">
            <span class="fas fa-search"></span>
        </div>
        <div class="profile-icon">
            <span class="fas fa-user"></span>
        </div>
        <div class="cancel-icon">
            <span class="fas fa-times"></span>
        </div>
        <form action="search-result.php" method="POST">
            <input type="search" class="search-data" name="search" placeholder="Search" required>
            <button type="submit" class="fas fa-search"></button>
            
        </form>
        <div class="profile-menu">
            <ul>
            <?php 
                if(isset($_SESSION['username']) && $_SESSION['login'] == true){
                    echo '<li><a href="student-profile.php"><i class="fas fa-user-circle"></i> View Profile</a></li>';
                    echo '<li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>';
                    echo '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>';
                } else {
                    echo '<li><a href="loginpage.php"><i class="fas fa-sign-in-alt"></i> Sign In</a></li>';
                }
            ?>
            </ul>
        </div>
    </nav>

    <script>
        const menuBtn = document.querySelector(".menu-icon span");
        const searchBtn = document.querySelector(".search-icon");
        const cancelBtn = document.querySelector(".cancel-icon");
        const items = document.querySelector(".nav-items");
        const form = document.querySelector("form");
        const profileBtn = document.querySelector(".profile-icon");
        const profileMenu = document.querySelector(".profile-menu");


        menuBtn.onclick = () => {
            items.classList.add("active");
            menuBtn.classList.add("hide");
            searchBtn.classList.add("hide");
            cancelBtn.classList.add("show");
        }

        cancelBtn.onclick = () => {
            items.classList.remove("active");
            menuBtn.classList.remove("hide");
            searchBtn.classList.remove("hide");
            cancelBtn.classList.remove("show");
            form.classList.remove("active");
            cancelBtn.style.color = "#fff";
        }

        searchBtn.onclick = () => {
            form.classList.add("active");
            searchBtn.classList.add("hide");
            cancelBtn.classList.add("show");
        }

        profileBtn.onclick = () => {
            profileMenu.classList.toggle("active");
        }

        document.addEventListener("click", (event) => {
            if (!profileMenu.contains(event.target) && !profileBtn.contains(event.target)) {
                profileMenu.classList.remove("active");
            }

            if (!form.contains(event.target) && !searchBtn.contains(event.target)) {
                form.classList.remove("active");
                searchBtn.classList.remove("hide");
                cancelBtn.classList.remove("show");
            }
        });

    </script>
</body>
</html>