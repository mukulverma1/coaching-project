<?php 
require_once 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,400;0,700;1,400&display=swap');

        :root {
            --main-color: #ffe34d ;
            /* --secondary-color: #a29bfe; */
            --lighter-color: #e0e0e7;
            /* --light-color: #b0b0c0; */
            /* --secondary-color:#b2ec5d; */
            --dark-color: #52505e;
            --font-smaller: 14px;
            --font-bigger: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            line-height: 1.5;
            height: 100vh;
            background-color: ghostwhite;
            /* display: flex; */
        }

        .container {
            max-width: 1100px;
            /* margin: 3rem auto; */
            /* padding: 0 0; */
            
        }

        .form-box {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            /* background-color: transparent ; */
            /* border-radius: 15px; */
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .progress {
            margin-top: 50px;
            /* padding: 1.5rem; */
            background-color: #faf9ff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--dark-color);
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo span {
            color: var(--main-color);
        }

        .progress-steps {
            list-style: none;
            display: flex;
            justify-content: space-between;
            padding: 0 1rem;
        }

        .progress-steps li {
            position: relative;
            text-align: center;
            flex: 1;
        }

        .progress-steps li::before {
            content: '';
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 25px;
            height: 25px;
            background-color: var(--lighter-color);
            border-radius: 50%;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--dark-color);
            transition: background-color 0.3s ease;
        }

        .progress-steps li.active::before {
            background-color: var(--main-color);
            color: white;
        }

        .progress-steps li.completed::before {
            background-color: var(--main-color);
            color: white;
        }

        .progress-steps li:nth-child(1)::before { content: '1'; }
        .progress-steps li:nth-child(2)::before { content: '2'; }
        .progress-steps li:nth-child(3)::before { content: '3'; }
        .progress-steps li:nth-child(4)::before { content: '4'; }
        .progress-steps li:nth-child(5)::before { content: '5'; }

        .progress-steps li:not(:last-child)::after {
            content: '';
            position: absolute;
            top: -13px;
            left: calc(50% + 12px);
            width: calc(100% - 24px);
            height: 2px;
            background-color: var(--lighter-color);
            transition: background-color 0.3s ease;
        }

        .progress-steps li.completed:not(:last-child)::after {
            background-color: var(--main-color);
        }

        .progress-steps li p {
            margin: 0;
            font-weight: bold;
            font-size: var(--font-smaller);
        }

        .progress-steps li span {
            font-size: var(--font-smaller);
            color: var(--light-color);
            display: none;
        }

        form {
            padding: 1.5rem;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        h2 {
            margin-bottom: 1rem;
            color: var(--main-color);
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--lighter-color);
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-prev {
            background-color: var(--lighter-color);
            color: var(--dark-color);
        }

        .btn-next, .btn-submit {
            background-color: var(--main-color);
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .profile-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            width: 100%;
            max-width: 300px;
            text-align: center;
            margin: 0 auto 20px;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: #000;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 14px;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-btn {
            background-color: var(--main-color);
            /* background-color: #8e44ad; */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .upload-btn:hover {
            background-color: #732d91;
        }

        #imageUpload {
            display: none;
        }

        .experience {
    display: flex;
    /* justify-content: flex-start; */
    margin-right: 5px;
    margin: 2px;
}
.experience label {
    display: block;
    margin-bottom: 5px;
}

        @media (min-width: 768px) {

            .container {
                overflow: hidden;
                border-radius: 40px;
            }

            .form-box {
                flex-direction: row;
            }

            .progress {
                flex: 1;
                max-width: 300px;
                padding: 2rem;
                margin-top: 0px;
            }

            .logo {
                font-size: 1.7rem;
            }

            form {
                flex: 2;
                padding: 2rem;
            }

            .progress-steps {
                flex-direction: column;
                padding: 0;
            }

            .progress-steps li {
                text-align: left;
                margin-bottom: 1.5rem;
                padding-left: 3rem;
            }

            .progress-steps li::before {
                left: 0;
                top: 0;
                transform: none;
            }

            .progress-steps li:not(:last-child)::after {
                left: 12px;
                top: 25px;
                width: 2px;
                height: calc(100% - 12px);
            }

            .progress-steps li span {
                display: inline;
            }

            h2 {
                font-size: 1.75rem;
            }

            body{
               height: 100vh;
      /* background-color: transparent;
     background-image: linear-gradient(180deg,#AFE6FD 100px , #FFFFFF ); */
            }
        }

        @media (min-width: 1024px) {

            .container {
                margin: 3.5rem auto;
                border: 5px solid gold;
            }

            .progress {
                padding: 3rem;
            }

            form {
                padding: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <div class="progress">
                <div class="logo"><span>.MUKUL</span>DEVELOPER</div>
                <ul class="progress-steps">
                    <li class="active">
                        <p>User Profile</p>
                        <span>15 secs to complete</span>
                    </li>
                    <li>
                        <p>Personal Information</p>
                        <span>25 secs to complete</span>
                    </li>
                    <li>
                        <p>Professional Details</p>
                        <span>30 secs to complete</span>
                    </li>
                    <li>
                        <p>Qualifications</p>
                        <span>25 secs to complete</span>
                    </li>
                    <li>
                        <p>Additional Information</p>
                        <span>25 secs to complete</span>
                    </li>
                </ul>
            </div>

            <form id="teacherForm"  action="registration-form.php" enctype="multipart/form-data" method="POST">
                <div class="form-step active">
                    <h2>User Profile</h2>
                    <div class="profile-card">
                        <div class="profile-image" id="profileImage">
                            <img src="data:image/jpeg;base64,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" alt="Profile Picture" id="preview">
                        </div>
                        <input type="file" id="imageUpload" name="name" accept="image/*">
                        <label for="imageUpload" class="upload-btn">Upload Image</label>
                    </div>
                </div>
                <div class="form-step">
                    <h2>Personal Information</h2>
                    <p>Enter your Personal Information Correctly</p>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="fullName" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_no">Contact No</label>
                        <input type="tel" id="phone" name="phone_no" required>
                    </div>
                </div>
                <div class="form-step">
                    <h2>Professional Details</h2>
                    <div class="form-group">
                        <label for="teacherType">Type of Teacher</label>
                        <select id="teacherType" name="teachertype" required>
                            <option value="">Select type</option>
                            <option value="home_tutor">Home Tutor</option>
                            <option value="coaching_teacher">Coaching Teacher</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="coachingname">Coaching Name (If Any)</label>
                        <input type="text" id="coachingName" name="coachingname">
                    </div>
                    <div class="form-group">
                        <label for="coachingaddress">Coaching Address (If Any)</label>
                        <input type="text" id="coachingAddress" name="coachingaddress">
                    </div>
                    <div class="form-group">
                        <label for="subjects">Subjects</label>
                        <input type="text" id="subjects" name="subjects" required>
                    </div>
                </div>
                <div class="form-step">
                    <h2>Qualifications</h2>
                    <div class="form-group">
                        <label for="qualification">Qualifications</label>
                        <input type="text" id="qualifications" name="qualification" required>
                    </div>
                    <div class="form-group">
                        <label for="experience">Experience</label>
                        <div class="experience">
                            <div class="mm-section">
                                <label  for="experience_yy"></label>
                                <input type="text" id="month" maxlength="2" name="experience_yy" placeholder="YY">
                            </div>
                            <div class="experience-mm">
                                <label for="experience_mm"></label>
                                <input type="text" id="day" maxlength="2" name="experience_mm" placeholder="MM">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="certification">Certification (If Any)</label>
                        <input type="text" id="certification" name="certification">
                    </div>
                    <div class="form-group">
                        <label for="awards">Awards (If Any)</label>
                        <input type="text" id="awards" name="awards">
                    </div>
                </div>
                <div class="form-step">
                    <h2>Additional Information</h2>
                    <div class="form-group">
                        <label for="biodata">Bio Data</label>
                        <textarea id="bioData" name="biodata" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Location (Full Address)</label>
                        <textarea id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="others">Others (Any Other Information)</label>
                        <textarea id="others" name="others" rows="4"></textarea>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-prev" disabled>Back</button>
                    <button type="button" class="btn btn-next">Next</button>
                    <button type="submit" value="submit" name="submit" class="btn btn-submit" style="display: none;">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
     document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('teacherForm');
    const steps = Array.from(form.getElementsByClassName('form-step'));
    const progressSteps = Array.from(document.getElementsByClassName('progress-steps')[0].children);
    const prevBtn = form.querySelector('.btn-prev');
    const nextBtn = form.querySelector('.btn-next');
    const submitBtn = form.querySelector('.btn-submit');
    let currentStep = 0;

    function showStep(step) {
        steps[currentStep].classList.remove('active');
        steps[step].classList.add('active');
        progressSteps[currentStep].classList.remove('active');
        progressSteps[step].classList.add('active');
        currentStep = step;

        for (let i = 0; i < progressSteps.length; i++) {
            if (i < currentStep) {
                progressSteps[i].classList.add('completed');
            } else {
                progressSteps[i].classList.remove('completed');
            }
        }

        if (currentStep === 0) {
            prevBtn.disabled = true;
        } else {
            prevBtn.disabled = false;
        }

        if (currentStep === steps.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
        } else {
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
        }
    }

    function validateStep(step) {
        const inputs = steps[step].querySelectorAll('input, select, textarea');
        for (let input of inputs) {
            if (input.hasAttribute('required') && !input.value) {
                alert('Please fill all required fields.');
                return false;
            }
        }
        return true;
    }

    prevBtn.addEventListener('click', function() {
        if (currentStep > 0) {
            showStep(currentStep - 1);
        }
    });

    nextBtn.addEventListener('click', function() {
        if (validateStep(currentStep) && currentStep < steps.length - 1) {
            showStep(currentStep + 1);
        }
    });

    form.addEventListener('submit', function(e) {
        if (!validateStep(currentStep)) {
            e.preventDefault(); // Prevent form submission if validation fails
        }
        // Remove this line to allow form submission
        // e.preventDefault();
    });

    // Image upload preview
    const imageUpload = document.getElementById('imageUpload');
    const preview = document.getElementById('preview');
    const profileImage = document.getElementById('profileImage');

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
});
    </script>
</body>
</html>


<?php 
require_once 'connection.php';
    if (isset($_POST["submit"])) {

        $full_name       = $_POST['full_name'];
        $email           = $_POST['email'];
        $phone_no        = $_POST['phone_no'];
        $teachertype     = $_POST['teachertype'];
        $coachingname    = $_POST['coachingname'];
        $coachingaddress = $_POST['coachingaddress'];
        $subjects        = $_POST['subjects'];
        $qualification   = $_POST['qualification'];
        $experience_yy   = $_POST['experience_yy'];
        $experience_mm   = $_POST['experience_mm'];
        $certification   = $_POST['certification'];
        $awards          = $_POST['awards'];
        $biodata         = $_POST['biodata'];
        $city            = $_POST['city'];
        $address         = $_POST['address'];
        $others          = $_POST['others'];
        $file            = $_FILES['name'];

        $destfile = ''; 
        $filename = $file['name'];
        $filepath = $file['tmp_name'];
        $fileerror = $file['error'];
     
       if($fileerror == 0){

        $destfile= 'images/'.$filename;

        move_uploaded_file($filepath , $destfile);
       }

        $sql = "INSERT INTO teacher_data (full_name, email, phone_no, teachertype, coachingname, coachingaddress, subjects, qualification, experience_yy , experience_mm , certification, awards, biodata, city, address, others ,destfile ) 
                VALUES ('$full_name', '$email', '$phone_no', '$teachertype', '$coachingname', '$coachingaddress', '$subjects', '$qualification', '$experience_yy', '$experience_mm', '$certification', '$awards', '$biodata', '$city', '$address', '$others' , '$destfile')";
    $result=mysqli_query($conn,$sql);   
        
        if ($result) {
            // echo "Data inserted successfully";

            $update = "UPDATE `teacher_data` SET `teacher`='yes'";
            $successfully = mysqli_query($conn,$update); 

            if($successfully)
            echo '<script type="text/javascript">
           window.location = "index.php";
      </script>';

      else
      echo "Error inserting data: " . mysqli_error($conn);
            
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    
        // Close connection
        mysqli_close($conn);
    }
?>