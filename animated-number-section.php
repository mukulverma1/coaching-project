<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Statistics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .animated-number {
            font-family: 'Poppins', sans-serif;
            /* min-height: 100vh; */
            margin:30px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            border: 3px solid gold;
            border-radius: 20px;
            padding: 5px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            max-width: 1200px;
            width: 90%;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
        }

        .container-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 30px;
        }

        .container-grid .container {
            border-radius: 15px;
            /* padding: 20px; */
            text-align: center;
            transition: transform 0.3s ease;
        }

        .container-grid .container:hover {
            transform: translateY(-5px);
            background: #ffd700;
        }

        .container i {
            font-size: 2rem;
            /* font-size: 2px; */
            margin-bottom: 15px;
        }

        .num {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .text {
            font-size: 1rem;
            font-weight: 400;
        }

        @media screen and (max-width: 768px) {
            .wrapper {
                padding: 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .container i {
                font-size: 1.5rem;
            }

            .num {
                font-size: 2rem;
            }

            .text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>


    <section class="animated-number">

    <div class="wrapper">
        <!-- <h1>Lorem ipsum dolor sit amet.</h1> -->
        <div class="container-grid">
            <div class="container">
                <!-- <i class="fas fa-chalkboard-teacher"></i> -->
                <i class="fas fa-thumbs-up"></i>

                <div class="num" data-val="50">000</div>
                <div class="text">Total Review</div>
            </div>
            <div class="container">
                <i class="fas fa-user-graduate"></i>
                <div class="num" data-val="50">000</div>
                <div class="text">Total Students</div>
            </div>
            <div class="container">
                <i class="fas fa-chalkboard-teacher"></i>
                <div class="num" data-val="50">000</div>
                <div class="text">Total Teachers</div>
            </div>
            <div class="container">
                <i class="fa-solid fa-city"></i>
                <div class="num" data-val="60">000</div>
                <div class="text">Total Citys</div>
            </div>
        </div>
    </div>

    </section>

    <script>
        let valueDisplays = document.querySelectorAll(".num");
        let interval = 4000;

        valueDisplays.forEach((valueDisplay) => {
            let startValue = 0;
            let endValue = parseInt(valueDisplay.getAttribute("data-val"));
            let duration = Math.floor(interval / endValue);
            let counter = setInterval(function () {
                startValue += 1;
                valueDisplay.textContent = startValue;
                if (startValue == endValue) {
                    clearInterval(counter);
                }
            }, duration);
        });
    </script>
</body>
</html>