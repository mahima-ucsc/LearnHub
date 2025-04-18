<?php include $this->resolve("partials/_header.php"); ?>

<head>

    <link rel="stylesheet" href="/assets/styles/Review/edit_review.css">
</head>

<section class="edit-review-container">
    <div class="edit-review-card">
        <h1 class="page-title">Edit Your Review</h1>
        <!-- Example success message (hidden by default) -->
        <div class="success-message" style="display: none;">
            <i class="fas fa-check-circle"></i>
            Your review has been updated successfully!
        </div>

        <form action="/course/review/edit/<?php echo $review['review_id'] ?>" method="POST" id="editReviewForm">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <div class="rating-input">
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" <?php echo ($review['rating'] == '5') ? 'checked' : ''; ?>>
                    <label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4" <?php echo ($review['rating'] == '4') ? 'checked' : ''; ?>>
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3" <?php echo ($review['rating'] == '3') ? 'checked' : ''; ?>>
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2" <?php echo ($review['rating'] == '2') ? 'checked' : ''; ?>>
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1" <?php echo ($review['rating'] == '1') ? 'checked' : ''; ?>>
                    <label for="star1"><i class="fas fa-star"></i></label>
                </div>
            </div>

            <div class="form-group">
                <label for="reviewText">Your Review</label>
                <textarea
                    id="reviewText"
                    name="review"
                    rows="6"
                    placeholder="Share your updated thoughts about this course..."
                    required><?php echo e($review['review']); ?></textarea>
                <div class="error-message" style="display: none;">Please enter your review</div>
            </div>

            <div class="button-group">
                <button type="submit" class="submit-btn">
                    Update Review
                </button>
                <a href="/profile" class="cancel-btn">
                    Cancel
                </a>
            </div>
        </form>
    </div>


    <script>
        // // Form submission handling
        // document.getElementById('editReviewForm').addEventListener('submit', function(e) {
        //     e.preventDefault();

        //     // Basic validation
        //     const reviewText = document.getElementById('reviewText');
        //     const rating = document.querySelector('input[name="rating"]:checked');
        //     const errorMessage = document.querySelector('.error-message');
        //     const successMessage = document.querySelector('.success-message');

        //     let isValid = true;

        //     if (!reviewText.value.trim()) {
        //         reviewText.classList.add('error');
        //         errorMessage.style.display = 'block';
        //         isValid = false;
        //     } else {
        //         reviewText.classList.remove('error');
        //         errorMessage.style.display = 'none';
        //     }

        //     if (!rating) {
        //         document.querySelector('.star-rating').classList.add('error');
        //         isValid = false;
        //     } else {
        //         document.querySelector('.star-rating').classList.remove('error');
        //     }

        //     if (isValid) {
        //         // Simulate successful submission
        //         successMessage.style.display = 'flex';
        //         // In a real application, you would submit the form here
        //         // this.submit();
        //     }
        // });
    </script>

</section>