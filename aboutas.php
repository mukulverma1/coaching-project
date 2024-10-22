<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Our Company</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f0f4f8;
            /* background-color: #f4f4f4; */
        }

        .hero {
            /* background-image: url('https://public.blob.vercel-storage.com/eEZHAoPTOBSYGBE/hero-background-2wQkCaG1suDIZOD5klDp8dpZb32zVg.jpg');
            background-size: cover;
            background-position: center; */
            /* height: 100vh; */
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(44, 62, 80, 0.7);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        section {
            padding: 5rem 0;
        }

        h2 {
            margin-bottom: 2rem;
            text-align: center;
            color: #2c3e50;
        }

        .team-members {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .team-member {
            background-color: #fff;
            border-radius: 15px;
            padding: 2rem;
            margin: 1rem;
            text-align: center;
            width: 300px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .team-member:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .team-member img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
            border: 4px solid #3498db;
            transition: transform 0.3s ease;
        }

        .team-member:hover img {
            transform: scale(1.1);
        }

        .team-member h3 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .team-member p {
            color: #7f8c8d;
            font-style: italic;
        }

        .developer-profile {
            background-color: #fff;
            border-radius: 15px;
            padding: 3rem;
            margin: 2rem auto;
            max-width: 800px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .developer-profile h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .developer-info {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .developer-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 2rem;
            border: 4px solid #3498db;
        }

        .developer-details h3 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .developer-details p {
            color: #7f8c8d;
            margin-bottom: 0.5rem;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .skill {
            background-color: #3498db;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .team-members {
                flex-direction: column;
                align-items: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .developer-info {
                flex-direction: column;
                text-align: center;
            }

            .developer-info img {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>

    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h1>About Our Company</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </section>

        <section id="about" class="container">
            <h2>Our Story</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus quas cumque porro aliquid fugiat quod iste voluptatum dolor nam impedit voluptates saepe at, exercitationem facere expedita culpa ipsa. Eum aspernatur laboriosam est nisi veritatis optio assumenda unde cumque doloribus impedit!</p>
        </section>

        <section id="team" class="container">
            <h2>Our Team</h2>
            <div class="team-members">
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.Ft5A2_jMsvEXSOkWX4tzyAHaHU?w=193&h=191&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Vipin Verma">
                    <h3>Vipin Verma</h3>
                    <p>CEO</p>
                </div>
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.MilJTNZ-v3g8wBGTWfjYagHaGf?w=211&h=186&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="img">
                    <h3>Atul Kumar</h3>
                    <p>CTO</p>
                </div>
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.xEGjXhPM6U8n5kqblBc8GwHaE8?w=265&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="img">
                    <h3>Mukul Verma</h3>
                    <p>Lead Designer</p>
                </div>
            </div>
        </section>

        <section id="developer" class="container">
            <div class="developer-profile">
                <h2>Featured Developer</h2>
                <div class="developer-info">
                    <img src="https://th.bing.com/th/id/OIP.IwkHL3nwLgbKABWKBQk2UwHaHY?w=172&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="img">
                    <div class="developer-details">
                        <h3>Mukul Verma</h3>
                        <p>Senior Full-Stack Developer</p>
                        <p>5+ years of experience in web development</p>
                        <div class="skills">
                            <span class="skill">JavaScript</span>
                            <span class="skill">React</span>
                            <span class="skill">Node.js</span>
                            <span class="skill">Python</span>
                            <span class="skill">AWS</span>
                        </div>
                    </div>
                </div>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse numquam aliquid praesentium unde non quaerat deleniti adipisci obcaecati earum aspernatur ex illum qui quae vitae, assumenda soluta! Laborum, veniam sequi nihil illo minus dolorem magni consequatur cumque provident rerum. Ratione recusandae tempore iste voluptatibus ad nam ut cupiditate maxime sunt?</p>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });                                                        //#about,  
            const fadeInElements = document.querySelectorAll('.team-member, #contact, .developer-profile');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });

            fadeInElements.forEach(element => {
                element.style.opacity = 0;
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(element);
            });
        });
    </script>
</body>
</html>