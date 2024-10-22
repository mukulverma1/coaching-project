<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />

   <style>
    .contactUs {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    margin: 0;
    padding: 0;
    /* background-color: #f4f4f4; */
    /* background-color: gold; */
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    border: 5px solid gold;
}

/* .contactUs .container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
} */

.contactUs h1 {
    text-align: center;
    color: #2c3e50;
}

.contactUs h2 {
    color: #2c3e50;
}

.contactUs .content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.contactUs .form-section,
.contactUs .info-section {
    flex-basis: 100%;
    margin-bottom: 20px;
}

@media (min-width: 768px) {
    .contactUs .form-section,
    .contactUs .info-section {
        flex-basis: 48%;
    }
}

.contactUs .form-group {
    margin-bottom: 15px;
}

.contactUs label {
    display: block;
    margin-bottom: 5px;
}

.contactUs input,
.contactUs textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.contactUs button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    /* border: none; */
    border: 1px solid black;
    border-radius: 4px;
    cursor: pointer;
}

.contactUs button:hover {
    background-color: #2980b9;
}

.contactUs .contact-info {
    background-color: #fff;
    padding: 20px;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.contactUs .info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.contactUs .icon {
    width: 24px;
    height: 24px;
    margin-right: 10px;
    color: #3498db;
}

.contactUs .info-item i{
    color: #2980b9;
    font-size: 1.2em;
    margin-right: 15px;
}

.contactUs .toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #2ecc71;
    color: white;
    padding: 15px;
    border-radius: 4px;
    display: none;
}

   </style>

</head>
<body>
   
    <div class="contactUs">
        <div class="container">
            <h1>Contact Us</h1>
            
            <div class="content">
             
                
                <div class="info-section">
                    <h2>Our Contact Information</h2>
                    <div class="contact-info">
                        <div class="info-item">
                            <i class="fa-solid fa-phone"></i>
                            <span>9005421652</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-envelope"></i>
                            <span>xyz@example.com</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>
                              Lorem ipsum dolor sit amet consectetur adipisicing.
                            </span>
                        </div>
                    </div>
                </div>
    
                <div class="form-section">
                    <h2>Send us a message</h2>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            Message Sent! We'll get back to you soon.
        </div>
    </div>

      <script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Get form values
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;

    // Log form data (in a real application, you would send this to a server)
    console.log('Form submitted:', { name, email, message });

    // Show toast notification
    var toast = document.getElementById('toast');
    toast.style.display = 'block';

    setTimeout(function() {
        toast.style.display = 'none';
    }, 3000);

    // Reset form fields
    this.reset();
});

  </script>

</body>
</html>