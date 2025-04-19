<?php include $this->resolve("partials/_header.php"); ?>

<style>
    :root {
        --primary: #FFC400;
        --primary-dark: #e6b000;
        --primary-light: #fff0c2;
        --accent: #FF7849;
        --dark: #1A1A2E;
        --dark-2: #16213E;
        --gray-light: #f8f9fa;
        --gray: #e9ecef;
        --gray-dark: #6c757d;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        --radius: 12px;
        --radius-sm: 8px;
        --transition: all 0.3s ease;
        --success: #28a745;
    }

    /* Layout */
    .profile {
        color: #171A1F;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        flex-direction: column;
        max-width: 1200px;
        margin: 0 auto;
    }

    .main-container {
        display: flex;
        width: 100%;
        gap: 50px;
        margin-left: 0;
    }

    .left-container,
    .right-container {
        border-radius: 16px;
        padding: 40px;
        transition: box-shadow 0.3s ease;
    }

    /* User Profile */
    .avatar {
        text-align: center;
        margin-bottom: 28px;
        display: flex;
        justify-content: center;
    }

    .avatar img {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #FFC400;
        transition: transform 0.3s ease;
    }

    .user-data {
        text-align: center;
        margin-bottom: 36px;
    }

    .user-data .name {
        font-family: 'Archivo', sans-serif;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1a1a1a;
    }

    .user-data .username {
        font-size: 18px;
        color: #565D6D;
    }

    /* User Info */
    .user-info {
        margin-top: 50px;
        margin-bottom: 30px;
        padding-bottom: 20px;
    }

    .user-info h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .user-info h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .user-bio {
        font-size: 16px;
        line-height: 1.6;
        color: #4a4a4a;
        margin-bottom: 20px;
    }

    /* Tags Section */
    .tags {
        margin-top: 36px;
    }

    .tags h4 {
        font-size: 16px;
        line-height: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tags p {
        display: inline-block;
        background-color: #e9ecef;
        margin: 4px;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 14px;
        color: #2c3e50;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    /* Contact and Social Lists */
    .contact-list,
    .social-list,
    .skills-list {
        list-style-type: none;
        padding: 0;
    }

    .contact-list li,
    .social-list li {
        font-size: 14px;
        margin-bottom: 8px;
        color: #565D6D;
    }

    .contact-list i,
    .social-list i {
        width: 20px;
        margin-right: 10px;
        color: #FFC400;
    }

    .social-list a {
        text-decoration: none;
        color: #565D6D;
        transition: color 0.3s ease;
    }

    .social-list a:hover {
        color: #FFC400;
    }

    /* Skills List */
    .skills-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .skills-list li {
        background-color: #f0f2f5;
        color: #2c3e50;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    /* Buttons */
    .edit-button {
        width: 100%;
        padding: 14px 20px;
        font-size: 18px;
        font-weight: 600;
        color: #584300;
        background-color: #FFC400;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(255, 196, 0, 0.2);
    }

    .edit-button:hover {
        background-color: #FFD033;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 196, 0, 0.3);
    }

    .edit-button:active {
        background-color: #C79900;
        transform: translateY(0);
    }

    .btn-submit,
    .btn-cancel,
    .btn-delete-account,
    .btn-delete {
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit {
        background-color: #FFC400;
        color: #584300;
    }

    .btn-submit:hover {
        background-color: #FFD033;
    }

    .btn-cancel {
        background-color: #f0f2f5;
        color: #2c3e50;
    }

    .btn-cancel:hover {
        background-color: #e9ecef;
    }

    .btn-delete-account,
    .btn-delete {
        background-color: #ff4d4d;
        color: #ffffff;
    }

    .btn-delete-account {
        display: block;
        width: 100%;
        margin-top: 20px;
    }

    .btn-delete-account:hover,
    .btn-delete:hover {
        background-color: #ff3333;
    }

    /* Teacher Courses Section */
    .teacher-courses-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #e0e0e0;
    }

    .teacher-course-title {
        margin-bottom: 12px;
        font-size: 20px;
    }

    /* Course Card Styles */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(292px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .course-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: var(--transition);
    }

    .course-card-link:hover {
        transform: translateY(-10px);
    }

    .course-card-link:hover .course-card {
        box-shadow: var(--shadow-hover);
    }

    .course-card-link:hover .course-image img {
        transform: scale(1.05);
    }

    .course-card {
        background-color: var(--white);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .course-image {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .course-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: var(--primary);
        color: var(--dark);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        z-index: 1;
    }

    .course-location {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: rgba(0, 0, 0, 0.6);
        color: var(--white);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
        z-index: 1;
    }

    .course-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .course-content-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .course-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .course-subject {
        background-color: rgba(220, 223, 53, 0.25);
        font-size: 12px;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
        z-index: 1;
    }

    .course-description {
        font-size: 14px;
        color: var(--gray-dark);
        margin-bottom: 15px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-meta {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .course-instructor {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .instructor-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .instructor-name {
        font-size: 13px;
        font-weight: 500;
    }

    .course-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        font-weight: 600;
    }

    .course-rating i {
        color: var(--primary);
    }

    .course-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: var(--gray-light);
        border-top: 1px solid var(--gray);
    }

    .course-price {
        font-weight: 600;
        font-size: 15px;
    }

    .onetime-payment-tag {
        color: rgb(58, 58, 58);
        font-weight: 300;
        font-size: 10px;
    }

    .course-details {
        display: flex;
        gap: 15px;
        font-size: 13px;
        color: var(--gray-dark);
    }

    .course-detail {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .course-detail i.fa-money-bill {
        color: var(--success);
    }

    /* Review Section Styles */
    .reviews-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #e0e0e0;
    }

    .review-title {
        font-size: 32px;
    }

    .reviews-summary {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        align-items: center;
    }

    .overall-rating {
        flex: 0 0 250px;
        text-align: center;
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .rating-number {
        font-size: 32px;
        font-weight: 700;
        color: #FFC400;
        margin-bottom: 0.5rem;
    }

    .rating-stars {
        color: #FFC400;
        font-size: 18px;
        margin-bottom: 0.5rem;
    }

    .rating-stars .star {
        color: #e3e3e3;
    }

    .rating-stars .star.active {
        color: #FFC107;
    }

    .rating-stars .star.half-active {
        background: linear-gradient(to right, #FFC107 50%, #e3e3e3 50%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .rating-text {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .rating-breakdown {
        flex: 1;
    }

    .rating-bar {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .rating-label {
        flex: 0 0 60px;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .progress-bar {
        flex: 1;
        height: 10px;
        background: #e9ecef;
        border-radius: 5px;
        overflow: hidden;
        margin: 0 1rem;
    }

    .progress-bar .progress {
        height: 100%;
        background: #FFC400;
        border-radius: 5px;
    }

    .rating-percentage {
        flex: 0 0 40px;
        text-align: right;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .reviews-header h3 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .total-reviews {
        color: #565D6D;
        font-size: 14px;
    }

    /* Review Card */
    .review-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .review-card:hover {
        background: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .reviewer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .reviewer-name {
        font-weight: 600;
        color: #2c3e50;
    }

    .review-date {
        color: #565D6D;
        font-size: 14px;
    }

    .review-course {
        font-size: 14px;
        color: #565D6D;
        margin-bottom: 10px;
    }

    .review-text {
        color: #2c3e50;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .review-rating {
        color: #FFC400;
        font-size: 14px;
    }

    /* Cart Menu Styles */
    .cart-menu {
        position: relative;
        display: inline-block;
    }

    .cart-btn {
        background: none;
        border: none;
        padding: 4px;
        cursor: pointer;
    }

    .cart-btn svg.size-6 {
        width: 20px;
        height: 20px;
        color: #333;
    }

    .cart-options {
        display: none;
        position: absolute;
        top: 25px;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    .menu-button {
        display: flex;
        justify-content: center;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .cart-options button {
        padding: 8px 12px;
        border: none;
        background: none;
        text-align: left;
        cursor: pointer;
        color: #333;
    }

    .cart-options button:hover {
        background-color: #f5f5f5;
    }

    /* Load More Button */
    .load-more-btn {
        padding: 12px 24px;
        background-color: #f8f9fa;
        border: none;
        border-radius: 8px;
        color: #2c3e50;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .load-more-btn:hover {
        background-color: #e9ecef;
    }

    /* Add Review Section */
    .add-review-section {
        margin-top: 2rem;
        padding: 1.5rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .review-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .rating-input {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .star-rating {
        display: flex;
        justify-content: center;
        flex-direction: row-reverse;
        gap: 0.25rem;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        cursor: pointer;
        color: #ddd;
        font-size: 1.5rem;
    }

    .star-rating input:checked~label,
    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #ffd700;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 500;
        color: #333;
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .form-group select,
    .form-group textarea,
    .form-group input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #FFC400;
    }

    .submit-review-btn {
        background-color: #FFC400;
        color: rgb(0, 0, 0);
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .submit-review-btn:hover {
        background-color: #ffd700;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
        max-width: 90%;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .main-container {
            flex-direction: column;
        }

        .left-container,
        .right-container {
            width: 100%;
            max-width: none;
        }
    }

    @media (max-width: 768px) {
        .user-info h2 {
            font-size: 22px;
        }

        .user-info h3 {
            font-size: 16px;
        }

        .user-bio {
            font-size: 14px;
        }

        .contact-list li,
        .social-list li,
        .skills-list li {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .profile {
            padding: 10px;
            margin-left: 0;
        }

        .left-container,
        .right-container {
            padding: 24px;
        }

        .avatar img {
            width: 120px;
            height: 120px;
        }

        .user-data .name {
            font-size: 28px;
        }

        .user-data .username {
            font-size: 16px;
        }
    }
</style>

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
                    <?php echo e($userDetails['first_name'] . ' ' . $userDetails['last_name']); ?>
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