<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("course/sidebar/sidebar.php"); ?>

<link rel="stylesheet" href="/assets/styles/Course/course-info.css">

<section class="course-info-container">
    <div class="course-page-wrapper">
        <div class="main-content">
            <div class="course-header">
                <h1 class="course-info-title"><?php echo e($course['title']); ?></h1>
                <div class="course-meta">
                    <div class="course-rating">★★★★★ 4.8 (256 reviews)</div>
                    <div class="course-info">
                        <span>Participants: <?php echo e($participantCount); ?></span> |
                        <span>Grade: <?php echo e($course['grade_id']); ?></span> |
                        <?php if ($course['price']): ?>
                            <span>
                                Price: Rs. <?php echo e($course['price']); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php if ($course['billing_type'] === 'onetime' && !$course['is_paid']): ?>
                        <a href="<?= "/payment/courses/" . $course['course_id'] ?>" class="enroll-button">Enroll Now</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="teacher-section">
                <img src="/assets/images/user.jpeg" alt="John Doe" class="teacher-avatar">
                <div class="teacher-info">
                    <h3> <?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?></h3>
                    <p><?php echo e($user['description']); ?></p>
                </div>
            </div>

            <div class="course-section">
                <h2 class="section-title">Course Description</h2>
                <p class="course-description">
                    <?php echo e($course['description']); ?>
                </p>
            </div>

            <?php if ($course['billing_type'] === 'onetime' && $course['is_paid']): ?>
                <div class="course-section">
                    <h2 class="section-title">Course Modules</h2>
                    <div class="module-list">
                        <?php foreach ($modules as $module): ?>
                            <?php include $this->resolve("course/course-info/course-module.php"); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif ($course['billing_type'] === 'recurring'): ?>
                <div class="course-section">
                    <h2 class="section-title">Current Content</h2>
                    <div class="period-list">
                        <?php foreach ($currentContent as $period): ?>
                            <div class="period-item">
                                <div class="period-header">
                                    <div class="period-title">
                                        <h4><?= formatDate($period['start_datetime'], 'Y M j') . " - " . formatDate($period['end_datetime'], 'Y M j') ?></h4>
                                    </div>
                                    <?php if ($period['is_paid']): ?>
                                        <div class="period-toggle">
                                            <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </div>
                                    <?php else: ?>
                                        <a class="pay-button" href="<?= "/payment/courses/" . $course['course_id'] . "/" . $period['sub_period_id'] ?>">Pay Now</a>
                                    <?php endif; ?>
                                </div>

                                <div class="period-content">
                                    <div class="module-list">
                                        <?php if ($period['is_paid'] || $period['is_free_access_period']): ?>
                                            <?php foreach ($period['modules'] as $module): ?>
                                                <?php include $this->resolve("course/course-info/course-module.php"); ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="no-access-message">
                                                <p>You don't have access to this content. Please pay to unlock.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="course-section">
                    <h2 class="section-title">Past Content</h2>
                    <div class="period-list">
                        <?php foreach ($pastContent as $period): ?>
                            <div class="period-item">
                                <div class="period-header">
                                    <div class="period-title">
                                        <h4><?= formatDate($period['start_datetime'], 'Y M j') . " - " . formatDate($period['end_datetime'], 'Y M j') ?></h4>
                                    </div>
                                    <?php if ($period['is_paid']): ?>
                                        <div class="period-toggle">
                                            <svg class="chevron-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </div>
                                    <?php else: ?>
                                        <a class="pay-button" href="<?= "/payment/courses/" . $course['course_id'] . "/" . $period['sub_period_id'] ?>">Pay Now</a>
                                    <?php endif; ?>
                                </div>

                                <div class="period-content">
                                    <div class="module-list">
                                        <?php if ($period['is_paid']): ?>
                                            <?php foreach ($period['modules'] as $module): ?>
                                                <?php include $this->resolve("course/course-info/course-module.php"); ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="no-access-message">
                                                <p>You don't have access to this content. Please pay to unlock.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Assignments -->
            <div class="course-section">
                <h2 class="section-title">Assignments</h2>

                <?php foreach ($assignments as $item): ?>
                    <div class="assignment-item">
                        <div class="assignment-header" onclick="toggleAssignment(this)">
                            <h5><?php echo e($item['title']); ?>
                                <span class="chevron-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </h5>
                        </div>

                        <div class="assignment-content">
                            <div class="assignment-details">
                                <p onclick="window.location.href='/courses/<?php echo e($course['course_id']); ?>/assignment/<?php echo e($item['assignment_id']); ?>'" style="cursor: pointer;"><?php echo e($item['instruction']); ?></p>
                                <div class="assignment-meta">
                                    <span class="deadline">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        <?php echo e($item['deadline']); ?>
                                    </span>
                                </div>
                                <?php foreach ($assignmentsResources[$item['assignment_id']] as $resource): ?>
                                    <ul>
                                        <li>
                                            <a href="/assignment/<?php echo e($item['assignment_id']) ?>/resource/<?php echo e($resource['resource_id']) ?>" class="resource-link">
                                                <span class="resource-icon">📄</span>
                                                <?php echo e($resource['resource_path']) ?>
                                            </a>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>
                                <form class="assignment-upload" action="/submit-assignment" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="module_id" value="1">
                                    <div class="file-upload">
                                        <input type="file" name="assignment_file" id="assignment-1" required>
                                        <label for="assignment-1" class="file-label">
                                            Choose File
                                        </label>
                                    </div>
                                    <button type="submit" class="submit-assignment" onclick="preventDefault();">Submit Assignment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Review Section -->
    <div class="course-section reviews-section">
        <h2 class="section-title">Student Reviews</h2>
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
                        <img src="<?php echo htmlspecialchars($review['profile_picture_url']); ?>" alt="<?php echo htmlspecialchars($review['name']); ?>" class="review-avatar">
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
                                        <a href="/courses/review/edit/<?php echo e($review['review_id']); ?>">Edit</a>
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
                    <form id='submit' method="POST" action="/delete-course-review">
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
            <form class="review-form" id="newReviewForm" method="POST" action="/add-course-review">
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
                <input type="hidden" name="course_id" value=<?php echo ($course['course_id']) ?> />

                <button type="submit" class="submit-review-btn">
                    Submit Review
                </button>
            </form>
        </div>
    </div>


    <script src="/assets/js/courses/course-info.js" defer></script>
    <script src="/assets/js/components/toast.js"></script>

    <!-- TODO: Move this script to course-info.js. Do not use inline functions -->
    <script>
        function toggleAssignment(headerElement) {
            const assignmentItem = headerElement.closest('.assignment-item');
            const content = assignmentItem.querySelector('.assignment-content');
            const chevron = headerElement.querySelector('.chevron-icon');

            content.classList.toggle('active');
            chevron.classList.toggle('rotated');
        }
    </script>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>
<!-- for review -->
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
    let counter = 0;

    function getmorereview() {
        event.preventDefault();
        const courseID = <?php echo json_encode($course['course_id']); ?>;
        console.log()
        fetch(`/course/review/${courseID}/${counter}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(element => {
                        document.querySelector('.reviews-list')
                            .insertAdjacentHTML('beforeend', `
                                <div class="review-item">
                                    <div class="review-header">
                                        <!-- avatar -->
                                        <img src="${element.profile_picture_url}" alt="${element.name}" class="review-avatar">
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
                                                        <a href="/course/review/edit/${element.review_id}">Edit</a>
                                                    </div>
                                                    <div class="menu-button">
                                                        <button onclick="showDeleteModal(${element.review_id})">delete</button>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- user review text -->
                                    <div class="review-body">
                                        <p><?php echo $element['rating'] ?></p>  
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