<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn__SignUp__Landing__Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
        * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body, input {
    font-family: 'Roboto', sans-serif;
}

.container {
    position: relative;
    width: 100%;
    min-height: 100vh;
    background-color: #fff;
    overflow: hidden;
}

.container:before {
    content: '';
    position: absolute;
    width: 2000px;
    height: 2000px;
    border-radius: 50%;
    background: linear-gradient(-45deg, #001236, #090c11);
    top: -10%;
    right: 48%;
    transform: translateY(-50%);
    z-index: 6;
    transition: 1.8s ease-in-out;
}

.forms-container {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.signin-signup {
    position: absolute;
    top: 50%;
    left: 75%;
    transform: translate(-50%, -50%);
    width: 50%;
    display: grid;
    grid-template-columns: 1fr;
    z-index: 5;
    transition: 1s 0.7s ease-in-out;
}

form {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    padding: 0 5rem;
    grid-column: 1/2;
    grid-row: 1/2;
    transition: 0.2s 0.7s ease-in-out;
}

form.sign-in-form {
    z-index: 2;
}

form.sign-up-form {
    z-index: 1;
    opacity: 0;
}

.title {
    font-size: 2.2rem;
    color: #444;
    margin-bottom: 10px;
}

.input-field {
    max-width: 380px;
    width: 100%;
    height: 55px;
    background-color: #cac9c9;
    margin: 10px 0;
    border-radius: 55px;
    display: grid;
    grid-template-columns: 15% 85%;
    padding: 0 0.4rem;
}

.input-field i {
    text-align: center;
    line-height: 55px;
    color: #181717;
    font-size: 1.1rem;
}

.input-field input {
    background: none;
    outline: none;
    border: none;
    line-height: 1;
    font-weight: 600;
    font-size: 1.1rem;
    color: #333;
}

.input-field input::placeholder {
    color: #495c81;
    font-weight: 500;
}

.btn {
    width: 150px;
    height: 49px;
    outline: none;
    border: none;
    border-radius: 49px;
    background-color: #090c11;
    color: #fff;
    font-weight: 600;
    text-transform: capitalize;
    margin: 10px 0;
    cursor: pointer;
    transition: 0.5s;
}

.btn:hover {
    background-color: #001236;
}

.social-text {
    padding: 0.7rem 0;
    font-size: 1rem;
}

.social-media {
    display: flex;
    justify-content: center;
}

.social-icon {
    height: 46px;
    width: 46px;
    border: 1px solid #333;
    margin: 0 0.45rem;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: #333;
    font-size: 1.1rem;
    border-radius: 50%;
    transition: 0.3s;
}

.social-icon:hover {
    color: #011f5a;
    border-color: #011f5a;
}

.panels-container {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}

.panel {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: space-around;
    text-align: center;
    z-index: 7;
}

.left-panel {
    pointer-events: all;
    padding: 3rem 17% 2rem 12%;
}

.right-panel {
    pointer-events: none;
    padding: 3rem 12% 2rem 17%;
}

.panel .content {
    color: #fff;
    transition: 0.9s 0.6s ease-in-out;
}

.panel h3 {
    font-weight: 600;
    line-height: 1;
    font-size: 1.5rem;
}

.panel p {
    font-size: 0.95rem;
    padding: 0.7rem 0;
}

.btn.transparent {
    margin: 0;
    background: none;
    border: 2px solid #fff;
    width: 130px;
    height: 41px;
    font-weight: 600;
    font-size: 0.8rem;
}

.image {
    width: 100%;
    transition: 1.1s 0.4s ease-in-out;
}

.right-panel .content, .right-panel .image {
    transform: translateX(800px);
}

/* ANIMATION STYLING */

.container.sign-up-mode:before {
    transform: translate(100%, -50%);
    right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
    transform: translateX(-800px);
}

.container.sign-up-mode .right-panel .image,
.container.sign-up-mode .right-panel .content {
    transform: translateX(0px);
}

.container.sign-up-mode .left-panel {
    pointer-events: none;
}

.container.sign-up-mode .right-panel {
    pointer-events: all;
}

.container.sign-up-mode .signin-signup {
    left: 25%;
}

.container.sign-up-mode form.sign-in-form {
    z-index: 1;
    opacity: 0;
}

.container.sign-up-mode form.sign-up-form {
    z-index: 2;
    opacity: 1;
}

/* Responsiveness */
@media (max-width: 768px) {
    .container {
        min-height: 800px;
        height: 100vh;
    }

    .container:before {
        width: 1500px;
        height: 1500px;
        left: 30%;
        bottom: 68%;
        transform: translateX(-50%);
        right: initial;
        top: initial;
        transition: 2s ease-in-out;
    }

    .signin-signup {
        width: 100%;
        left: 50%;
        top: 95%;
        transform: translate(-50%, -100%);
        transition: 1s 0.8s ease-in-out;
    }

    .panels-container {
        grid-template-columns: 1fr;
        grid-template-rows: 1fr 2fr 1fr;
    }

    .panel {
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        padding: 2.5rem 8%;
    }

    .panel .content {
        padding-right: 15%;
        transition: 0.9s 0.8s ease-in-out;
    }

    .panel h3 {
        font-size: 1.2rem;
    }

    .panel p {
        font-size: 0.7rem;
        padding: 0.5rem 0;
    }

    .btn.transparent {
        width: 110px;
        height: 35px;
        font-size: 0.7rem;
    }

    .image {
        width: 200px;
        transition: 0.9s 0.6s ease-in-out;
    }

    .left-panel {
        grid-row: 1/2;
    }

    .right-panel {
        grid-row: 3/4;
    }

    .right-panel .content, .right-panel .image {
        transform: translateY(300px);
    }

    .container.sign-up-mode:before {
        transform: translate(-50%, 100%);
        bottom: 32%;
        right: initial;
    }

    .container.sign-up-mode .left-panel .image,
    .container.sign-up-mode .left-panel .content {
        transform: translateY(-300px);
    }

    .container.sign-up-mode .signin-signup {
        top: 5%;
        transform: translate(-50%, 0);
        left: 50%;
    }
}

@media (max-width: 576px) {
    form {
        padding: 0 1.5rem;
    }

    .panel .content {
        padding: 0.5rem 1rem;
    }

    .container {
        padding: 1.5rem;
    }

    .container:before {
        bottom: 72%;
        left: 50%;
    }

    .container.sign-up-mode:before {
        bottom: 28%;
        left: 50%;
    }
}

.hidden {
    display: none;
}

#resendOtpBtn {
    margin-left: 10px;

}
    </style>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <form action="/coaching-project/loginpage.php" method="POST" class="sign-in-form">
                    <h2 class="title">Sign In</h2>
                    <div class="input-field">
                        <i class="fa-solid fa-phone"></i>
                        <input name="phone_no" type="text" id="signInContactNumber" placeholder="Contact Number" required>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <input type="button" value="Send OTP" id="sendOtpSignInBtn" class="btn solid">
                    </div>
                    <div class="input-field otp-field hidden" id="signInOtpSection">
                        <i class="fa-solid fa-lock"></i>
                        <input type="text" id="signInOtp" placeholder="One Time Password">
                    </div>
                    <div style="display:flex">
                        <input type="submit" name="submit" value="Sign In" class="btn solid hidden" id="signInBtn">
                        <input type="button" value="Resend OTP" id="resendOtpSignInBtn" class="btn solid hidden">
                    </div>
                </form>

                <form action="" method="" class="sign-up-form">
                    <h2 class="title">Sign Up</h2>
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-phone"></i>
                        <input type="text" id="signUpContactNumber" placeholder="Contact Number" name="phone_no" required>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <input type="button" value="Send OTP" id="sendOtpSignUpBtn" class="btn solid">
                    </div>
                    <div class="input-field otp-field hidden" id="signUpOtpSection">
                        <i class="fa-solid fa-lock"></i>
                        <input type="text" id="signUpOtp" placeholder="One Time Password">
                    </div>
                    <div style="display:flex">
                        <input type="submit" name="submit" value="Sign Up" class="btn solid hidden" id="signUpBtn">
                        <input type="button" value="Resend OTP" id="resendOtpSignUpBtn" class="btn solid hidden">
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, illo. Vitae, nesciunt.</p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <!-- <img src="/images/Profiling_Monochromatic.png" class="image" alt=""> -->
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, illo. Vitae, nesciunt.</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <!-- <img src="/images/Authentication_Outline.png" class="image" alt=""> -->
            </div>
        </div>
    </div>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        // Sign In Form Elements
        const sendOtpSignInBtn = document.querySelector("#sendOtpSignInBtn");
        const resendOtpSignInBtn = document.querySelector("#resendOtpSignInBtn");
        const signInOtpSection = document.querySelector("#signInOtpSection");
        const signInBtn = document.querySelector("#signInBtn");

        // Sign Up Form Elements
        const sendOtpSignUpBtn = document.querySelector("#sendOtpSignUpBtn");
        const resendOtpSignUpBtn = document.querySelector("#resendOtpSignUpBtn");
        const signUpOtpSection = document.querySelector("#signUpOtpSection");
        const signUpBtn = document.querySelector("#signUpBtn");

        sign_up_btn.addEventListener('click', () => {
            container.classList.add("sign-up-mode");
        });

        sign_in_btn.addEventListener('click', () => {
            container.classList.remove("sign-up-mode");
        });

        sendOtpSignInBtn.addEventListener('click', () => {
            const contactNumber = document.querySelector("#signInContactNumber").value;

            if (contactNumber.trim() === "") {
                alert("Please enter your contact number.");
                return;
            }

            // Simulate sending OTP logic here (e.g., AJAX request)

            // Show OTP section, resend OTP button, and hide Send OTP button
            signInOtpSection.classList.remove('hidden');
            sendOtpSignInBtn.classList.add('hidden');
            resendOtpSignInBtn.classList.remove('hidden');
            signInBtn.classList.remove('hidden');
        });

        resendOtpSignInBtn.addEventListener('click', () => {
            // Simulate resending OTP logic here (e.g., AJAX request)

            // Provide feedback to the user
            alert("OTP has been resent.");

            // Optionally, disable the Resend OTP button after clicking and re-enable after some time
            resendOtpSignInBtn.disabled = true;
            setTimeout(() => {
                resendOtpSignInBtn.disabled = false;
            }, 60000); // Example: re-enable after 1 minute
        });

        sendOtpSignUpBtn.addEventListener('click', () => {
            const contactNumber = document.querySelector("#signUpContactNumber").value;

            if (contactNumber.trim() === "") {
                alert("Please enter your contact number.");
                return;
            }

            // Simulate sending OTP logic here (e.g., AJAX request)

            // Show OTP section, resend OTP button, and hide Send OTP button
            signUpOtpSection.classList.remove('hidden');
            sendOtpSignUpBtn.classList.add('hidden');
            resendOtpSignUpBtn.classList.remove('hidden');
            signUpBtn.classList.remove('hidden');
        });

        resendOtpSignUpBtn.addEventListener('click', () => {
            // Simulate resending OTP logic here (e.g., AJAX request)

            // Provide feedback to the user
            alert("OTP has been resent.");

            // Optionally, disable the Resend OTP button after clicking and re-enable after some time
            resendOtpSignUpBtn.disabled = true;
            setTimeout(() => {
                resendOtpSignUpBtn.disabled = false;
            }, 60000); 
        });
    </script>
</body>
</html>


<?php 

include("connection.php");

if(isset($_POST["submit"])){
    $phone = $_POST['phone_no'];

    $select = "SELECT * FROM `teacher_data` WHERE `phone_no` = '$phone'";
    $query = mysqli_query($conn, $select);
    $num = mysqli_num_rows($query);
    
    if($num == 1){   
        $row = mysqli_fetch_assoc($query);
        
        $username = $row['full_name'];
        $phone_no = $row['phone_no'];

        echo $username;

        session_start(); 
        $_SESSION['username'] = $username;
        $_SESSION['phone_no'] = $phone_no; // Add phone_no to the session
        $_SESSION['login'] = true;

        header('location:index.php');
    } else {
        echo "<p>Invalid phone number</p>";
    }
}
?>





