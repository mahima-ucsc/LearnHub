<?php include $this->resolve("partials/_header.php"); ?>

<link rel="stylesheet" href="/assets/styles/main.css">
<link rel="stylesheet" href="/assets/styles/components/course-card.css">


<section class="main">
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Unlock Your Potential with LearnHub</h1>
                <p>Discover a world of knowledge at your fingertips. Start your learning journey today!</p>
                <div class="cta-buttons">
                    <?php if ($_SESSION['user']): ?>
                        <a href="#courses" class="cta-primary get-start">Get Started</a>
                    <?php else: ?>
                        <a href="/register" class="cta-primary">Signup For Free</a>
                        <a href="/courses" class="cta-secondary">Explore Courses</a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <div class="welcome-section">
            <div class="welcome-inner">
                <div class="left">
                    <h2>Welcome To LearnHub!</h2>
                    <p><br>Discover a platform designed for independent tutors and small-group educators, where students can find the perfect match for their learning needs. Enjoy personalized, on-demand educational support with seamless class requests, real-time updates, and a powerful dashboard to organize schedules, track progress, and share resources. Click here to learn more about how we’re making education accessible and tailored just for you.</p>
                    <a href="/about">Learn more About Us</a>
                </div>
                <div class="right">
                    <img src="/assets/images/rm1.png" alt="">
                </div>
            </div>
        </div>

        <div class="courses-container">

            <section id="courses" class="courses">
                <h2>Popular Courses</h2>
                <hr class="line">
                <div class="card-container">
                    <div class="search-course-card">
                        <div class="course-card-header">
                            <img src="/assets/images/dm.jpg" alt="Web Development" class="course-image">
                            <h4 class="course-title">Introduction to Web Development</h4>
                            <hr class="course-card-line" />
                        </div>
                        <div class="course-description">

                            <p>Learn the basics of HTML, CSS, and JavaScript. Lorem ipsum dolor sit amet, </p>
                        </div>
                        <div class="course-info">
                            <div class="course-stat">
                                <p>
                                    <i class="fa fa-star icon"></i> 4.5
                                </p>
                                <p>
                                    <i class="fa fa-map-marker icon"></i>
                                    Colombo
                                </p>
                                <p class="price">
                                    Rs. 24,500/Course
                                </p>
                            </div>
                            <div class="course-meta">
                                <div class="course-teacher">
                                    <img src="/assets/images/user.jpeg" alt="teacher" />
                                    <p>Isuru Naveen</p>
                                </div>
                                <div>
                                    <a href="#"> See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search-course-card">
                        <div class="course-card-header">
                            <img src="/assets/images/intro-to-web.jpg" alt="Web Development" class="course-image">
                            <h4 class="course-title">Introduction to Web Development</h4>
                            <hr class="course-card-line" />
                        </div>
                        <div class="course-description">

                            <p>Learn the basics of HTML, CSS, and JavaScript. Lorem ipsum dolor sit amet, </p>
                        </div>
                        <div class="course-info">
                            <div class="course-stat">
                                <p>
                                    <i class="fa fa-star icon"></i> 4.5
                                </p>
                                <p>
                                    <i class="fa fa-map-marker icon"></i>
                                    Colombo
                                </p>
                                <p class="price">
                                    Rs. 2,500/Month
                                </p>
                            </div>
                            <div class="course-meta">
                                <div class="course-teacher">
                                    <img src="/assets/images/user.jpeg" alt="teacher" />
                                    <p>Isuru Naveen</p>
                                </div>
                                <div>
                                    <a href="#"> See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search-course-card">
                        <div class="course-card-header">
                            <img src="/assets/images/dataSci.png" alt="Web Development" class="course-image">
                            <h4 class="course-title">Introduction to Web Development lore</h4>
                            <hr class="course-card-line" />
                        </div>
                        <div class="course-description">

                            <p>Learn the basics of HTML, CSS, and JavaScript. Lorem ipsum dolor sit amet, Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae ut cumque iure sapiente eum illum eos sit iste voluptates facilis voluptate sunt ducimus eligendi molestiae, eaque illo non veniam? Repellendus? </p>
                        </div>
                        <div class="course-info">
                            <div class="course-stat">
                                <p>
                                    <i class="fa fa-star icon"></i> 4.5
                                </p>
                                <p>
                                    <i class="fa fa-map-marker icon"></i>
                                    Colombo
                                </p>
                                <p class="price">
                                    Rs. 1,000/Month
                                </p>
                            </div>
                            <div class="course-meta">
                                <div class="course-teacher">
                                    <img src="/assets/images/user.jpeg" alt="teacher" />
                                    <p>Isuru Naveen</p>
                                </div>
                                <div>
                                    <a href="#"> See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section id="tutors" class="tutors">
            <h2>Our Expert Tutors</h2>
            <hr>
            <div class="tutor-cards" onclick="window.location.href='/tutor'">
                <div class="tutor-card">
                    <img src="/assets/images/pp_placeholder.jpg" alt="Tutor 1">
                    <div class="tutor-info">
                        <h3>Isuru Naveen</h3>
                        <p>Computer Science</p>
                        <div class="tutor-social">
                            <i class="fab fa-facebook"></i> <!-- Facebook Icon -->
                            <i class="fab fa-instagram"></i> <!-- Instagram Icon -->
                            <i class="fab fa-youtube"></i> <!-- YouTube Icon -->
                            <i class="fas fa-envelope"></i> <!-- Email Icon -->

                        </div>
                    </div>
                </div>
                <div class="tutor-card" onclick="window.location.href='/tutor'">
                    <img src="/assets/images/pp_placeholder.jpg" alt="Tutor 2">
                    <div class="tutor-info">
                        <h3>Nadun Madusanka</h3>
                        <p>Data Science</p>
                        <div class="tutor-social">
                            <i class="fab fa-facebook"></i> <!-- Facebook Icon -->
                            <i class="fab fa-instagram"></i> <!-- Instagram Icon -->
                            <i class="fab fa-youtube"></i> <!-- YouTube Icon -->
                            <i class="fas fa-envelope"></i> <!-- Email Icon -->

                        </div>
                    </div>
                </div>
                <div class="tutor-card" onclick="window.location.href='/tutor'">
                    <img src="/assets/images/pp_placeholder.jpg" alt="Tutor 3">
                    <div class="tutor-info">
                        <h3>Kavinda Dimuthu</h3>
                        <p>Digital Marketing</p>
                        <div class="tutor-social">
                            <i class="fab fa-facebook"></i> <!-- Facebook Icon -->
                            <i class="fab fa-instagram"></i> <!-- Instagram Icon -->
                            <i class="fab fa-youtube"></i> <!-- YouTube Icon -->
                            <i class="fas fa-envelope"></i> <!-- Email Icon -->

                        </div>
                    </div>
                </div>
                <div class="tutor-card" onclick="window.location.href='/tutor'">
                    <img src="/assets/images/pp_placeholder.jpg" alt="Tutor 4">
                    <div class="tutor-info">
                        <h3>Nimantha </h3>
                        <p>Business Management</p>
                        <div class="tutor-social">
                            <i class="fab fa-facebook"></i> <!-- Facebook Icon -->
                            <i class="fab fa-instagram"></i> <!-- Instagram Icon -->
                            <i class="fab fa-youtube"></i> <!-- YouTube Icon -->
                            <i class="fas fa-envelope"></i> <!-- Email Icon -->

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="community-container">
            <section id="community" class="community">
                <div class="right">
                    <h2>Join Our Learning Community</h2>
                    <p>Connect with fellow learners, share your goals, and find the perfect course for your needs.</p>
                    <a href="/course/request/create" class="community-btn" id="post-requirement">Post Your Course Requirement</a>

                </div>
            </section>
        </div>

        <section class="features">
            <h2>Why Learn<span style="color:#FFC400;">Hub</span> ?</h2>

            <div class="feature-content">
                <div class="feature-left">
                    <!-- <h1>Join with Us!</h1>
                    <button class="feature-btn">Sign Up now!</button> -->
                    <img src="/assets/images/Online learning.svg" />
                </div>
                <div class="feature-cards">
                    <div class="feature-card">
                        <h3>Interactive Lessons</h3>
                        <p>Engage with dynamic content and real-time feedback.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Progress Tracking</h3>
                        <p>Monitor your learning journey with detailed analytics.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Personalized Learning Paths</h3>
                        <p>Tailored course recommendations based on your goals.</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="testimonial-content">

            <h2>See How We’ve Made an<br>Impact</h2>
            <hr />
            <div class="testimonial">
                <div class="testimonial-card">
                    <div class="title-section">
                        <p class="title">Easy To Use</p>
                        <p class="comma">"</p>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque nesciunt ea, cupiditate in iusto tempora <a href="" class=""></a>
                    </p>
                    <div class="user-data">
                        <img src="/assets/images/user.jpeg" alt="profile picture">
                        <div class="user-meta">
                            <p class="username">Kavinda Dimuthu</p>
                            <p class="userrole">Physics Teacher</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="title-section">
                        <p class="title">Easy To Use</p>
                        <p class="comma">"</p>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque nesciunt ea, cupiditate in iusto tempora <a href="" class=""></a>
                    </p>
                    <div class="user-data">
                        <img src="/assets/images/user.jpeg" alt="profile picture">
                        <div class="user-meta">
                            <p class="username">Kavinda Dimuthu</p>
                            <p class="userrole">Physics Teacher</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="title-section">
                        <p class="title">Easy To Use</p>
                        <p class="comma">"</p>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque nesciunt ea, cupiditate in iusto tempora <a href="" class=""></a>
                    </p>
                    <div class="user-data">
                        <img src="/assets/images/user.jpeg" alt="profile picture">
                        <div class="user-meta">
                            <p class="username">Kavinda Dimuthu</p>
                            <p class="userrole">Physics Teacher</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="title-section">
                        <p class="title">Easy To Use</p>
                        <p class="comma">"</p>
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque nesciunt ea, cupiditate in iusto tempora <a href="" class=""></a>
                    </p>
                    <div class="user-data">
                        <img src="/assets/images/user.jpeg" alt="profile picture">
                        <div class="user-meta">
                            <p class="username">Kavinda Dimuthu</p>
                            <p class="userrole">Physics Teacher</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- <aside class="advertisement">
        <h3>Special Offer!</h3>
        <p>Get 20% off on all courses this week. Use code: LEARN20</p>
        <button>Claim Offer</button>
    </aside> -->




    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const advertisement = document.querySelector('.advertisement');
            const claimOfferBtn = advertisement.querySelector('button');

            // Function to show the advertisement
            function showAdvertisement() {
                advertisement.style.display = 'block';
            }

            // Function to hide the advertisement
            function hideAdvertisement() {
                advertisement.style.display = 'none';
            }

            // Show the advertisement after 5 seconds
            setTimeout(showAdvertisement, 5000);

            // Hide the advertisement when the "Claim Offer" button is clicked
            claimOfferBtn.addEventListener('click', function() {
                hideAdvertisement();
                alert('Offer claimed! Use code LEARN20 at checkout.');
            });

        });

        document.querySelector('.get-start').addEventListener('click', function() {
            event.preventDefault();
            document.getElementById('courses').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
</section>
<?php include $this->resolve('partials/_footer.php'); ?>