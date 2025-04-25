<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/Tutor/tutor_profile.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="profile">
    <!-- teacher's bio -->
    <div class="main-container">
        <div class="profile-grid">
            <!-- Left sidebar with tutor info -->
            <div class="profile-sidebar">
                <div class="avatar-container">
                    <?php if ($tutorDetails['profile_picture_url']): ?>
                        <img class="avatar" src="<?php echo e($tutorDetails['profile_picture_url']); ?>" alt="<?php echo e($tutorDetails['first_name'] . ' ' . $tutorDetails['last_name']); ?>">
                    <?php else: ?>
                        <img class="avatar" src="/assets/images/user.jpeg" alt="<?php echo e($tutorDetails['first_name'] . ' ' . $tutorDetails['last_name']); ?>">
                    <?php endif; ?>
                </div>

                <h1 class="tutor-name"><?php echo e($tutorDetails['first_name'] . ' ' . $tutorDetails['last_name']); ?></h1>
                <p class="joined-date">
                    <i class="fas fa-calendar-alt"></i>
                    Joined <?php echo e(date('F Y', strtotime($tutorDetails['joined_date']))); ?>
                </p>

                <?php if ($tutorBasic['title']): ?>
                    <p class="bio-text"><?php echo e($tutorBasic['title']); ?></p>
                <?php endif; ?>

                <div class="section-divider"></div>

                <h2 class="section-title">
                    <i class="fas fa-user"></i> About Me
                </h2>
                <p class="bio-text">
                    <?php if ($tutorBasic['bio']): ?>
                        <?php echo e($tutorBasic['bio']); ?>
                    <?php elseif ($tutorDetails['description']): ?>
                        <?php echo e($tutorDetails['description']); ?>
                    <?php else: ?>
                        Professional tutor with a passion for teaching.
                    <?php endif; ?>
                </p>

                <h2 class="section-title">
                    <i class="fas fa-tags"></i> Specializations
                </h2>
                <div class="tag-container">
                    <?php if ($tutorSubjects): ?>
                        <?php foreach ($tutorSubjects as $tutorSubject): ?>
                            <span class="tag"><?php echo e($tutorSubject['subject_title']); ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ($tutorEducations): ?>
                        <?php foreach ($tutorEducations as $tutorEducation): ?>
                            <span class="tag"><?php echo e($tutorEducation['field_of_study']); ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right content area -->
            <div class="profile-content">
                <!-- Contact Information -->
                <div class="profile-card">
                    <h2 class="section-title">
                        <i class="fas fa-address-card"></i> Contact Information
                    </h2>

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span><?php echo e($tutorDetails['email']); ?></span>
                    </div>

                    <?php if ($tutorDetails['phone_no']): ?>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span><?php echo e($tutorDetails['phone_no']); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($tutorDetails['location']): ?>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo e($tutorDetails['location']); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (!$tutorDetails['phone_no'] && !$tutorDetails['location']): ?>
                        <p class="empty-state">Additional contact information not provided.</p>
                    <?php endif; ?>
                </div>

                <!-- Educational Background -->
                <div class="profile-card">
                    <h2 class="section-title">
                        <i class="fas fa-graduation-cap"></i> Educational Background
                    </h2>

                    <?php if (isset($tutorEducations)): ?>
                        <?php foreach ($tutorEducations as $index => $tutorEducation): ?>
                            <div class="info-grid">
                                <?php if ($tutorEducation['degree']): ?>
                                    <div class="info-item">
                                        <div class="info-label">Degree</div>
                                        <div class="info-value"><?php echo e($tutorEducation['degree']); ?></div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($tutorEducation['institution']): ?>
                                    <div class="info-item">
                                        <div class="info-label">Institution</div>
                                        <div class="info-value"><?php echo e($tutorEducation['institution']); ?></div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($tutorEducation['field_of_study']): ?>
                                    <div class="info-item">
                                        <div class="info-label">Field of Study</div>
                                        <div class="info-value"><?php echo e($tutorEducation['field_of_study']); ?></div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($tutorEducation['start_date'] && $tutorEducation['end_date']): ?>
                                    <div class="info-item">
                                        <div class="info-label">Duration</div>
                                        <div class="info-value"><?php echo e(date('Y', strtotime($tutorEducation['start_date']))); ?> - <?php echo e(date('Y', strtotime($tutorEducation['end_date']))); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($index < count($tutorEducations) - 1): ?>
                                <hr class="divider" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-state">Educational background information not provided.</p>
                    <?php endif; ?>
                </div>

                <!-- Teaching Experience -->
                <div class="profile-card">
                    <h2 class="section-title">
                        <i class="fas fa-chalkboard-teacher"></i> Teaching Experience
                    </h2>

                    <?php if (isset($tutorSubjects)): ?>
                        <?php foreach ($tutorSubjects as $index => $tutorSubject): ?>
                            <div class="info-grid">
                                <?php if ($tutorSubject['years_experience']): ?>
                                    <div class="info-item">
                                        <div class="info-label">Years of Experience</div>
                                        <div class="info-value"><?php echo e($tutorSubject['years_experience']); ?> years</div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($tutorSubject['subject_title']): ?>
                                    <div class="info-item">
                                        <div class="info-label">Subject Expertise</div>
                                        <div class="info-value"><?php echo e($tutorSubject['subject_title']); ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($index < count($tutorSubjects) - 1): ?>
                                <hr class="divider" />
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-state">Teaching experience information not provided.</p>
                    <?php endif; ?>
                </div>

                <!-- Availability -->
                <div class="profile-card">
                    <h2 class="section-title">
                        <i class="fas fa-clock"></i> Availability
                    </h2>

                    <?php $weeks = [
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday'
                    ];
                    ?>
                    <?php if (isset($tutorAvailablities)): ?>
                        <div class="availability-grid">
                            <?php foreach ($tutorAvailablities as $tutorAvailablity): ?>
                                <div class="day-slot">
                                    <div class="day-name"><?php echo $weeks[e($tutorAvailablity['day_of_week'])]; ?></div>
                                    <div class="time-slot">
                                        <?php echo e(date('g:i A', strtotime($tutorAvailablity['start_time']))); ?> -
                                        <?php echo e(date('g:i A', strtotime($tutorAvailablity['end_time']))); ?>
                                    </div>
                                    <?php if ($tutorAvailablity['is_recurring']): ?>
                                        <div class="time-slot">(Weekly)</div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="empty-state">Availability schedule not provided.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- teacher's courses -->
    <div class="teacher-courses-section">
        <div class="teacher-course-title">
            <h2>
                Courses By teacher
            </h2>
        </div>
        <section class="courses-grid" id="coursesGrid">
            <?php foreach ($courses as $course): ?>
                <a href="/courses/<?php echo $course['tutor_id']; ?>" class="course-card-link" onclick="showLoader()">
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
                                <?php if (isset($course['durationInHour'])): ?>
                                    <div class="course-detail">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo $course['durationInHour'] ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($course['grade_name'])): ?>
                                    <div class="course-detail">
                                        <span>Grade <?php echo $course['grade_name'] ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
        <div class="more-course">
            <button class="btn" onclick="window.location.href='/courses?s=<?php echo e($tutorDetails['first_name'] . '+' . $tutorDetails['last_name']); ?>'">more courses</button>
        </div>
    </div>

    <!-- reviews from students -->
    <!-- Review Section -->
    <div class="reviews-section">
        <h2 class="review-title ">Student Reviews</h2>

        <!-- review summary -->
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

        <!-- user review list -->
        <div class="reviews-list">
            <?php
            foreach ($userReview as $review): ?>
                <div class="review-item">
                    <div class="review-header">
                        <!-- avatar -->
                        <img src="<?= isset($review['profile_picture_url'])
                                        ? $user['profile_picture_url'] :
                                        "/assets/images/user_placeholder.jpg" ?>" alt=" <?php echo htmlspecialchars($review['name']); ?>" class="review-avatar">
                        <!-- since when-->
                        <div class="review-meta">
                            <span class="review-name"><?php echo htmlspecialchars($review['name']); ?></span>
                            <span class="review-date" id="review-date-<?php echo $review['review_id']; ?>">
                                <?php
                                $datetime = new DateTime($review['date']);
                                $date = $datetime->format('Y-m-d');
                                $days = calcDateDiff($date);
                                if ($days['years'] > 0) {
                                    echo ($days['years']) . " years ago";
                                } else if ($days['months'] > 0) {
                                    echo ($days['months']) . " months ago";
                                } else if ($days['days'] > 0) {
                                    echo ($days['days']) . " days ago";
                                } else {
                                    echo "Today";
                                }
                                ?>
                            </span>
                        </div>
                        <!-- review rate -->
                        <div class="review-rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $review['rating']
                                    ? '<span class="star active">★</span>'
                                    : '<span class="star">★</span>';
                            }
                            ?>
                        </div>
                        <!-- edit and delete menue -->
                        <?php
                        if ($review['user_id'] === $_SESSION['user'] || $_SESSION['user_role'] === "admin") : ?>
                            <div class="cart-menu">
                                <div class="cart-btn" onclick="toggleCartMenu(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </div>
                                <!-- Option menu-->
                                <div class="cart-options">
                                    <div class="menu-button">
                                        <a href="/tutor/reviews/edit/<?php echo e($review['review_id']); ?>">Edit</a>
                                    </div>
                                    <div class="menu-button">
                                        <button onclick="showDeleteModal(<?php echo e($review['review_id']); ?>)">Delete</button>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- user review text -->
                    <div class="review-body">
                        <p><?php echo htmlspecialchars($review['review']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- delete comformation allert -->
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
                    <form id='submit' method="POST" action="/delete-tutor-review">
                        <?php include $this->resolve("partials/_csrf.php"); ?>
                        <input type="hidden" id="delete-review_id" name="review_id" value="" />
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- pagination -->
        <div class="pagination">
            <button class="btn" onclick="getmorereview()">Show more</button>
        </div>

        <!-- Add review -->
        <div class="add-review-section">
            <h3>Add Your Review</h3>
            <form class="review-form" id="newReviewForm" method="POST" action="/add-tutor-review">
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
                        placeholder="Share your experience..."
                        required></textarea>
                </div>
                <input type="hidden" name="tutor_id" value=<?php echo ($tutorDetails['user_id']) ?> />

                <button type="submit" class="submit-review-btn">
                    Submit Review
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    // Toggle the display of the cart options
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

    //Delete confirmation
    const deleteModal = document.getElementById('deleteModal');

    function showDeleteModal(reviewId) {
        event.preventDefault(); // Prevent the form from submitting immediately
        deleteModal.style.display = 'block'; // show comform allert
        console.log(reviewId);
        document.getElementById('delete-review_id').value = reviewId; // set the review id to the hidden input
        document.body.style.overflow = 'hidden'; // Prevent scrolling of background content
    }

    function hideModal() {
        deleteModal.style.display = 'none';

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
        if (event.target === deleteModal) {
            hideModal();
        }
    }

    // Close modal on escape key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && deleteModal.style.display === 'block') {
            hideModal();
        }
    });

    // Show more reviews
    let counter = 1;

    function getmorereview() {
        event.preventDefault();
        const tutorId = <?php echo json_encode($tutorDetails['user_id']); ?>;
        const userId = <?php echo json_encode($_SESSION['user']); ?>;
        const userRoll = <?php echo json_encode($_SESSION['user_role']); ?>;

        fetch(`/tutor/review/${tutorId}/${counter}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(element => {
                        document.querySelector('.reviews-list')
                            .insertAdjacentHTML('beforeend', `
                                <div class="review-item">
                                    <div class="review-header">
                                        <!-- avatar -->
                                        <img src="${element.profile_picture_url ? element.profile_picture_url : "/assets/images/user_placeholder.jpg"}" alt="${element.name}" class="review-avatar">
                                        <!-- since when-->
                                        <div class="review-meta">
                                            <span class="review-name">${element.name}</span>
                                            <span class="review-date" id="review-date-${element.review_id}">${getDateDifference(element.date)}</span>
                                        </div>
                                        <!-- review rate -->
                                        <div class="review-rating">
                                            ${generateStarRating(element.rating)} 
                                        </div>
                                        <!-- edit and delete menue -->
                                        ${(element.user_id === userId || userRoll === "admin") ? `
                                            <div class="cart-menu">
                                                <div class="cart-btn" onclick="toggleCartMenu(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                                    </svg>
                                                </div>
                                                <!-- Option menu-->
                                                <div class="cart-options">
                                                    <div class="menu-button">
                                                        <a href="/courses/review/edit/${element.review_id}">Edit</a>
                                                    </div>
                                                    <div class="menu-button">
                                                        <button onclick="showDeleteModal(${element.review_id})">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        ` : ''}
                                    </div>
                                    <!-- user review text -->
                                    <div class="review-body">
                                        <p>${element.review}</p>  
                                    </div>
                                </div>
                            `);
                    });
                } else {
                    alert('No more reviews to load');
                }
            })
            .catch(error => {
                console.error('Error fetching reviews:', error);
                alert('An error occurred while loading more reviews.');
            });

        counter++;
    }

    // Function to calculate the difference between two dates
    function getDateDifference(dateString) {
        const inputDate = new Date(dateString);
        const today = new Date();

        // Calculate the time difference in milliseconds
        const diffTime = today - inputDate;

        // Calculate days difference
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const diffMonths = Math.floor(diffDays / 30);
        const diffYears = Math.floor(diffDays / 365);

        if (diffYears > 0) {
            return `${diffYears} year${diffYears > 1 ? 's' : ''} ago`;
        } else if (diffMonths > 0) {
            return `${diffMonths} month${diffMonths > 1 ? 's' : ''} ago`;
        } else if (diffDays > 0) {
            return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
        } else {
            return "Today";
        }
    }

    // Function to generate star rating HTML
    function generateStarRating(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            stars += `<span class="star ${i <= rating ? 'active' : ''}">★</span>`;
        }
        return stars;
    }
</script>

<?php
function calcDateDiff($startDate)
{
    $start = new DateTime($startDate);
    $end = new DateTime();

    $diff = $start->diff($end);

    return [
        'years' => $diff->y,
        'months' => $diff->m,
        'days' => $diff->d
    ];
}
?>