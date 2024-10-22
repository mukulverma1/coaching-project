<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ratings and Reviews</title>
    <style>
        /* styles.css */

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f4f8;
}

.container {
    width: 90%;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.review-form-section, .reviews-list-section {
    margin-bottom: 30px;
}

.review-form-section h2, .reviews-list-section h2 {
    color: #333;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-size: 16px;
    color: #333;
    margin-bottom: 5px;
}

input[type="number"], textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

textarea {
    resize: vertical;
}

button {
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.reviews-list-section {
    padding: 10px;
    border-top: 1px solid #ddd;
}

.review-card {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.review-rating {
    font-size: 24px;
    color: #ffcc00;
}

.review-text {
    font-size: 16px;
    color: #555;
    margin: 10px 0;
}

.review-author {
    font-size: 14px;
    color: #888;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Reviews</h1>
        
        <section class="review-form-section">
            <h2>Submit Your Review</h2>
            <form id="reviewForm">
                <div class="form-group">
                    <label for="rating">Rating (1-5):</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label for="reviewText">Review:</label>
                    <textarea id="reviewText" name="reviewText" rows="4" required></textarea>
                </div>
                <button type="submit">Submit Review</button>
            </form>
        </section>
        
        <section class="reviews-list-section">
            <h2>Reviews</h2>
            <div class="review-card">
                <div class="review-rating" data-rating="5"></div>
                <p class="review-text">Excellent teacher, very helpful!</p>
                <p class="review-author">Reviewed by: John Doe</p>
            </div>
            <div class="review-card">
                <div class="review-rating" data-rating="4"></div>
                <p class="review-text">Good teacher, but could be more patient.</p>
                <p class="review-author">Reviewed by: Jane Smith</p>
            </div>
            <!-- Add more reviews here -->
        </section>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
