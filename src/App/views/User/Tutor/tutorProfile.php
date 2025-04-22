<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Tutor/tutor_profile.css">

<section class="profile">
    <div class="main-container">
        <div class="left-container">
            <div class="avatar">
                <!-- User avatar image -->
                <img src="/assets/images/user.jpeg" alt="John Doe">
            </div>
            <div class="user-data">
                <!-- User name and username -->
                <h1 class="name">
                    <?php echo e($tutorDetails['first_name'] . ' ' . $tutorDetails['last_name']); ?>
                </h1>
                <p class="username">@john_doe</p>
            </div>
            <h2>About Me</h2>
            <!-- User bio -->
            <p class="user-bio">Passionate learner and aspiring software developer. I love exploring new technologies and pushing my boundaries in the world of coding.</p>

            <div class="tags">
                <h4>#TAGS</h4>
                <!-- List of tags -->
                <p>computer science</p>
                <p>physics</p>
                <p>chemistry</p>
                <p>English</p>
            </div>



        </div>
        <div class="right-container">
            <div class="user-info">

                <h2>About Me</h2>
                <!-- User bio -->
                <p class="user-bio">Passionate learner and aspiring software developer. I love exploring new technologies and pushing my boundaries in the world of coding.</p>

                <h3>Contact Information</h3>
                <!-- Contact information list -->
                <ul class="contact-list">
                    <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope"></i> johndoe@email.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> New York, NY</li>
                </ul>

                <h3>Social Media</h3>
                <!-- Social media links -->
                <ul class="social-list">
                    <li><a href="#"><i class="fab fa-twitter"></i> @john_doe</a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i> linkedin.com/in/johndoe</a></li>
                    <li><a href="#"><i class="fab fa-github"></i> github.com/johndoe</a></li>
                </ul>

                <h3>Skills</h3>
                <!-- List of skills -->
                <ul class="skills-list">
                    <li>JavaScript</li>
                    <li>Python</li>
                    <li>React</li>
                    <li>Node.js</li>
                    <li>SQL</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="teacher-courses-section">
        <div class="teacher-course-title">
            <h2>
                Courses By teacher
            </h2>
        </div>
        <section class="courses-grid" id="coursesGrid">
            <?php foreach ($courses as $course): ?>
                <a href="/courses/<?php echo $course['course_id']; ?>" class="course-card-link" onclick="showLoader()">
                    <div class="course-card">
                        <div class="course-image">
                            <img src="<?php echo '/storage/uploads/courses/thumbnails/' . $course['thumbnail_url']; ?>" alt="<?php echo e($course['title']); ?>">
                            <div class="course-location">
                                <span>
                                    <?php echo e($course['location']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="course-content">
                            <div class="course-content-header">
                                <h3 class="course-title">
                                    <?php echo e($course['title']); ?>
                                </h3>
                                <div class="course-subject">
                                    <span>
                                        <?php echo e($course['subject']); ?>
                                    </span>
                                </div>
                            </div>
                            <p class="course-description">
                                <?php echo e($course['description']); ?>
                            </p>
                            <div class="course-meta">
                                <div class="course-instructor">
                                    <img src="/assets/images/pp_placeholder.jpg" alt="<?php echo e($course['first_name']); ?>" class="instructor-avatar">
                                    <span class="instructor-name">
                                        <?php echo e($course['first_name'] . ' ' . $course['last_name']); ?>
                                    </span>
                                </div>
                                <div class="course-rating">
                                    <i class="fas fa-star"></i>
                                    <span>5</span>
                                    <span class="reviews">(10)</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-price">
                                <!-- <?php echo e($course['price']); ?> -->
                                <?php if (isset($course['billing_type'])): ?>
                                    <span>
                                        <?php echo $course['billing_type'] === 'onetime' ? 'Rs.' . e($course['price']) : '<i class="fas fa-money-bill" style="color: var(--success);"></i> Monthly payment'; ?>
                                    </span>
                                    <span class="onetime-payment-tag">
                                        <?php echo $course['billing_type'] === 'onetime' ? 'onetime payment' : ''; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="course-details">
                                <div class="course-detail">
                                    <i class="fas fa-clock"></i>
                                    <span>3H</span>
                                </div>
                                <div class="course-detail">
                                    <span>Grade 13</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
    </div>
    <div class="reviews-section">
        <h2 class="review-title">Student Reviews</h2>
        <div class="reviews-summary">
            <div class="overall-rating">
                <div class="rating-number">4.8</div>
                <div class="rating-stars">
                    <span class="star active">★</span>
                    <span class="star active">★</span>
                    <span class="star active">★</span>
                    <span class="star active">★</span>
                    <span class="star half-active">★</span>
                </div>
                <div class="rating-text">256 Total Reviews</div>
            </div>
            <div class="rating-breakdown">
                <div class="rating-bar">
                    <span class="rating-label">5 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 65%"></div>
                    </div>
                    <span class="rating-percentage">65%</span>
                </div>
                <div class="rating-bar">
                    <span class="rating-label">4 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 25%"></div>
                    </div>
                    <span class="rating-percentage">25%</span>
                </div>
                <div class="rating-bar">
                    <span class="rating-label">3 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 8%"></div>
                    </div>
                    <span class="rating-percentage">8%</span>
                </div>
                <div class="rating-bar">
                    <span class="rating-label">2 Stars</span>
                    <div class="progress-bar">
                        <div class="progress" style="width: 2%"></div>
                    </div>
                    <span class="rating-percentage">2%</span>
                </div>
            </div>
        </div>
        <!-- Review Cards -->
        <!-- Current user reviews-->
        <?php foreach ($userReview as $review) : ?>
            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-info">
                        <img src="/assets/images/user.jpeg" alt="Sarah Johnson" class="reviewer-avatar">
                        <div>
                            <div class="reviewer-name"><?php echo e($tutorDetails['first_name'] . ' ' . $userDetails['last_name']); ?></div>
                            <div class="review-course">
                                <i class="fas fa-graduation-cap"></i>
                                Advanced JavaScript Mastery
                            </div>
                        </div>
                    </div>
                    <span class="review-date">2 weeks ago</span>
                    <div class="cart-menu">
                        <div class="cart-btn" onclick="toggleCartMenu(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </div>
                        <!-- Option menu-->
                        <div class="cart-options">
                            <a class="menu-button" href="/review/edit/<?php echo e($review['review_id']); ?>">Edit</a>
                            <a href="#" class="menu-button" onclick="showModal()">Delete</a>
                        </div>
                    </div>
                </div>
                <p class="review-text"><?php echo $review['review'] ?></p>
                <div class="review-rating">
                    <?php
                    for ($i = 0; $i < $review['rating']; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }
                    ?>
                </div>
            </div>
            <!-- Delete confirmation -->

            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Confirm Delete</h3>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button onclick="hideModal()" class="btn btn-cancel">Cancel</button>
                        <form method="POST" action="/review/delete/<?php echo e($review['review_id']); ?>">

                            <?php include $this->resolve("partials/_csrf.php"); ?>
                            <input type="hidden" name="_METHOD" value="DELETE" />
                            <button type="submit" class="btn btn-delete">Delete</button>

                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="review-card">
            <div class="review-header">
                <div class="reviewer-info">
                    <img src="/assets/images/user.jpeg" alt="Sarah Johnson" class="reviewer-avatar">
                    <div>
                        <div class="reviewer-name">Sarah Johnson</div>
                        <div class="review-course">
                            <i class="fas fa-graduation-cap"></i>
                            Advanced JavaScript Mastery
                        </div>
                    </div>
                </div>
                <span class="review-date">2 weeks ago</span>
            </div>
            <p class="review-text">This course exceeded my expectations! John's teaching style is clear and engaging. The practical examples really helped me understand complex concepts.</p>
            <div class="review-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>

        <div class="review-card">
            <div class="review-header">
                <div class="reviewer-info">
                    <img src="/assets/images/user.jpeg" alt="Michael Chen" class="reviewer-avatar">
                    <div>
                        <div class="reviewer-name">Michael Chen</div>
                        <div class="review-course">
                            <i class="fas fa-graduation-cap"></i>
                            React & Redux for Beginners
                        </div>
                    </div>
                </div>
                <span class="review-date">1 month ago</span>
            </div>
            <p class="review-text">Great introduction to React! The course structure is well thought out and the projects are very practical. John is always quick to respond to questions.</p>
            <div class="review-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="load-more-container">
            <button class="load-more-btn">
                Load More Reviews
            </button>
        </div>
        <!-- Add review -->
        <div class="add-review-section">
            <h3>Add Your Review</h3>
            <form class="review-form" id="newReviewForm" method="POST" action="/add-review">
                <div class="rating-input">
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" required>
                        <label for="star5"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"><i class="fas fa-star"></i></label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="reviewText">Your Review:</label>
                    <textarea
                        id="reviewText"
                        name="review"
                        rows="4"
                        placeholder="Share your experience with this course..."
                        required></textarea>
                </div>
                <input type="hidden" name="tutor_id" value="1" />

                <button type="submit" class="submit-review-btn">
                    Submit Review
                </button>
            </form>
        </div>
    </div>
</section>
<script>
    // Cart menu
    function toggleCartMenu(button) {
        const cartOptions = button.nextElementSibling;
        cartOptions.style.display = cartOptions.style.display === 'block' ? 'none' : 'block';

        // Close the menu if clicked outside
        window.onclick = function(event) {
            if (!button.contains(event.target) && !cartOptions.contains(event.target)) {
                cartOptions.style.display = 'none';
            }
        }
    }

    function editCourse() {
        alert('Edit course clicked!');
        // Add your edit logic here
    }

    //Delete confirmation
    const modal = document.getElementById('deleteModal');

    function showModal() {
        modal.style.display = 'block';

        // Prevent scrolling of background content
        document.body.style.overflow = 'hidden';
    }

    function hideModal() {
        modal.style.display = 'none';

        // Restore scrolling
        document.body.style.overflow = 'auto';
    }

    function confirmDelete() {
        // Add your delete logic here
        console.log('Item deleted!');
        hideModal();
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target === modal) {
            hideModal();
        }
    }

    // Close modal on escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
            hideModal();
        }
    });

    function toggleCartMenu(button) {
        const cartOptions = button.nextElementSibling;
        cartOptions.style.display = cartOptions.style.display === 'block' ? 'none' : 'block';

        // Close the menu if clicked outside
        window.onclick = function(event) {
            if (!button.contains(event.target) && !cartOptions.contains(event.target)) {
                cartOptions.style.display = 'none';
            }
        }
    }
</script>

</html>