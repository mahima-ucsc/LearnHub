<?php include $this->resolve("partials/_header.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/profile-styles.css">
    <link rel="stylesheet" href="/assets/styles/Tutor/profile.css">
</head>

<section class="profile">
    <div class="main-container">
        <div class="left-container">
            <div class="tutor-cover-photo">
                <img src="/assets/images/cover.png" alt="">
            </div>
            <div class="avatar">
                <img src="/assets/images/user.jpeg" alt="John Doe">
            </div>
            <div class="user-data">
                <h1 class="name">
                    <?php echo e($userDetails['first_name'] . ' ' . $userDetails['last_name']); ?>
                </h1>
                <p class="username"><?php echo $userDetails['first_name'] ?></p>
            </div>

            <!-- Status badge -->
            <div class="status-badge">
                <span class="badge-active">
                    Active Instructor
                </span>
            </div>

            <!-- Quick stats-->
            <div class="quick-stats">
                <div class="stat-item">
                    <span class="stat-label">Students Taught</span>
                    <span class="stat-value">500+</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Course Rating</span>
                    <span class="stat-value">4.8/5.0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Member Since</span>
                    <span class="stat-value">2021</span>
                </div>
            </div>

            <!-- Contact button -->
            <a href="mailto:johndoe@email.com" class="contact-button">
                Contact Instructor
            </a>

        </div>

        <div class="right-container">
            <div class="user-info">
                <h2>About Me</h2>
                <p class="user-bio">Passionate educator with over 5 years of experience in software development. I specialize in teaching modern web technologies and helping students build real-world projects. My teaching philosophy focuses on practical, hands-on learning experiences that prepare students for professional development roles.</p>

                <h3>Expertise Areas</h3>
                <ul class="skills-list">
                    <li>Web Development</li>
                    <li>JavaScript</li>
                    <li>Python</li>
                    <li>React</li>
                    <li>Node.js</li>
                    <li>Database Design</li>
                    <li>System Architecture</li>
                    <li>UI/UX Design</li>
                </ul>

                <h3>Teaching Specialties</h3>
                <ul class="contact-list" style="margin-top: 15px;">
                    <li><i class="fas fa-check"></i> Beginner to Advanced Web Development</li>
                    <li><i class="fas fa-check"></i> Full-Stack JavaScript Development</li>
                    <li><i class="fas fa-check"></i> Modern Frontend Frameworks</li>
                    <li><i class="fas fa-check"></i> Database Management Systems</li>
                </ul>

                <h3>Connect With Me</h3>
                <ul class="social-list">
                    <li><a href="#"><i class="fab fa-twitter"></i> @john_doe</a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i> linkedin.com/in/johndoe</a></li>
                    <li><a href="#"><i class="fab fa-github"></i> github.com/johndoe</a></li>
                </ul>
            </div>

            <h3 class="active-courses-header">Active Courses</h3>
            <!-- Course cards -->
            <div class="course-cards-container">
                <div class="stat-container">
                    <div>
                        <h5>Advanced JavaScript Mastery</h5>
                        <p class="course-rating">4.9 ★ • 2,500 students</p>
                    </div>
                    <a href="#" class="view-course-button">
                        View Course
                    </a>
                </div>

                <div class="stat-container">
                    <div>
                        <h5>React & Redux for Beginners</h5>
                        <p class="course-rating">4.8 ★ • 1,800 students</p>
                    </div>
                    <a href="#" class="view-course-button">
                        View Course
                    </a>
                </div>

                <div class="stat-container">
                    <div>
                        <h5>Full Stack Web Development</h5>
                        <p class="course-rating">4.7 ★ • 3,200 students</p>
                    </div>
                    <a href="#" class="view-course-button">
                        View Course
                    </a>
                </div>
            </div>
        </div>
        <div class="reviews-section">
            <h2 class="review-title">Student Reviews</h2>
            <div class="reviews-summary">
                <!-- summary of reating -->
                <div class="overall-rating">
                    <div class="rating-number"><?php echo number_format($summeryOfReviews['avgRating'], 1) ?> / 5</div>
                    <div class="rating-stars">
                        <?php
                        if (($summeryOfReviews['avgRating'] - floor($summeryOfReviews['avgRating'])) > 0.4) {
                            $flag = true;
                        }
                        for ($i = 1; $i <= 5; $i++) {

                            if ($i <= $summeryOfReviews['avgRating']) {
                                echo '<span class="star active">★</span>';
                            } else if ($flag) {
                                echo '<span class="star half-active">★</span>';
                                $flag = false;
                            } else {
                                echo '<span class="star">★</span>';
                            }
                        }
                        ?>
                    </div>
                    <div class="rating-text"><?php echo $summeryOfReviews['totalReviews'] ?> Total Reviews</div>
                </div>
                <!-- all ratings with percentage -->
                <div class="rating-breakdown">
                    <?php
                    krsort($summeryOfReviews['starCount']);
                    foreach ($summeryOfReviews['starCount'] as $key => $value) : ?>
                        <div class="rating-bar">
                            <span class="rating-label"><?php echo $key ?> Stars</span>
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $summeryOfReviews['totalReviews'] > 0 ? ($value / $summeryOfReviews['totalReviews']) * 100 : 0; ?>%"></div>
                            </div>
                            <span class="rating-percentage"><?php echo number_format($summeryOfReviews['totalReviews'], 2) > 0 ? number_format($value / $summeryOfReviews['totalReviews'], 2) * 100 : 0; ?> %</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php
            // dd($userReview); 
            ?>

            <!-- Review Cards -->
            <!-- Current user reviews-->

            <?php
            // dd($userReview);
            foreach ($userReview as $review) : ?>
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="/assets/images/user.jpeg" alt="Sarah Johnson" class="reviewer-avatar">
                            <div>
                                <div class="reviewer-name"><?php echo e($userDetails['first_name'] . ' ' . $userDetails['last_name']); ?></div>
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
    </div>
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
</section>