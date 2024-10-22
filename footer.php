<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <title>Document</title>
    <style>
     
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        footer {
            background: #1c1c1c; 
            color: #f1f1f1; 
            padding-bottom: 15px;
            text-align: center;
        }

        .footerBottom {
            display: flex;
            flex-direction: column;
            align-items: center; 
            padding-top: 10px; 
        }

        footer p {
            color: #e0e0e0; 
            font-size: 16px; 
            font-family: 'Arial', sans-serif; 
        }

        .developed {
            opacity: 0.8; 
            text-transform: uppercase;
            letter-spacing: 1px; 
            font-weight: 400; 
            margin: 0 5px; 
            
        }

        .socialIcons {
            display: flex;
            gap: 20px; 
            /* margin-top: 10px;  */
            margin-bottom: 10px; 
        }

        .socialIcons a {
            color: #f1f1f1; 
            font-size: 24px; 
            text-decoration: none; 
            transition: color 0.3s ease, transform 0.3s ease; 
        }

        .socialIcons a:hover {
            color: #ffcc00;
            transform: scale(1.1); 
        }

        @media (max-width: 768px) {
            .footerBottom {
                flex-direction: column; 
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    
    <footer>
        <div class="footerBottom">
            <div class="socialIcons">
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" aria-label="Google Plus"><i class="fa-brands fa-google-plus"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>

            <p>Copyright &copy; 2024; Developed by <span class="developed">Mukul Verma</span></p>
         
        </div>
    </footer>

</body>
</html>