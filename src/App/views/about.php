<?php include $this->resolve("partials/_header.php"); ?>
<style>
    .cta-button {
        background-color: #FFC400;
        color: #333;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 30px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(255, 196, 0, 0.3);
    }

    .cta-button:hover {
        background-color: #E6B000;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(255, 196, 0, 0.4);
    }

    /* about-hero section */
    .about-hero {
        padding: 10rem 5% 6rem;
        background: linear-gradient(135deg, #FFF8E1 0%, #FFECB3 100%);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background-color: rgba(255, 196, 0, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        bottom: -150px;
        left: -150px;
        width: 300px;
        height: 300px;
        background-color: rgba(255, 196, 0, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .about-hero-content {
        position: relative;
        z-index: 1;
    }

    .about-hero h1 {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        color: #1e293b;
        position: relative;
        display: inline-block;
    }

    .about-hero h1::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 8px;
        background-color: #FFC400;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 4px;
    }

    .about-hero p {
        font-size: 1.25rem;
        max-width: 800px;
        margin: 2rem auto 2.5rem;
        color: #4b5563;
    }

    /* Mission section */
    .mission {
        padding: 6rem 5%;
        background-color: #fff;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-heading {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-heading h2 {
        font-size: 2.5rem;
        color: #1e293b;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .section-heading h2::after {
        content: '';
        position: absolute;
        width: 60px;
        height: 5px;
        background-color: #FFC400;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .section-heading p {
        font-size: 1.2rem;
        color: #64748b;
        max-width: 700px;
        margin: 0 auto;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
    }

    .mission-card {
        background-color: #f8fafc;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        border-top: 5px solid #FFC400;
    }

    .mission-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .mission-icon {
        font-size: 3rem;
        color: #FFC400;
        margin-bottom: 1.5rem;
        background-color: rgba(255, 196, 0, 0.1);
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .mission-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #1e293b;
    }

    .mission-card p {
        color: #64748b;
        font-size: 1.05rem;
    }

    /* Team section */
    .team {
        padding: 6rem 5%;
        background-color: #f8f9fc;
        position: relative;
    }

    .team::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background-color: rgba(255, 196, 0, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2.5rem;
        position: relative;
        z-index: 1;
    }

    .team-member {
        background-color: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
        position: relative;
    }

    .team-member:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    .member-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .member-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .team-member:hover .member-img {
        transform: scale(1.1);
    }

    .member-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 50%);
    }

    .member-info {
        padding: 1.8rem;
        text-align: center;
        position: relative;
    }

    .member-info::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 4px;
        background-color: #FFC400;
        border-radius: 2px;
    }

    .member-info h3 {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
        color: #1e293b;
    }

    .member-info p {
        color: #64748b;
        margin-bottom: 1.2rem;
        font-weight: 500;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .social-links a {
        color: #FFC400;
        background-color: rgba(255, 196, 0, 0.1);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .social-links a:hover {
        background-color: #FFC400;
        color: white;
        transform: translateY(-3px);
    }

    /* Stats section */
    .stats {
        padding: 5rem 5%;
        background-color: #FFC400;
        color: #333;
        position: relative;
        overflow: hidden;
    }

    .stats::before {
        content: '';
        position: absolute;
        top: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .stats-grid {
        display: flex;
        justify-content: space-between;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .stat-item {
        background-color: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .stat-item:hover {
        transform: translateY(-10px);
    }

    .stat-item h3 {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        color: #FFC400;
        position: relative;
        display: inline-block;
    }

    .stat-item p {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e293b;
    }

    /* Testimonials */
    .testimonials {
        padding: 6rem 5%;
        background-color: #fff;
        position: relative;
    }

    .testimonials::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background-color: rgba(255, 196, 0, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .testimonial-slider {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
        z-index: 1;
    }

    .testimonial-container {
        display: flex;
        transition: transform 0.5s ease;
    }

    .testimonial {
        min-width: 100%;
        padding: 3rem;
        background-color: #f8fafc;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        text-align: center;
        position: relative;
    }

    .testimonial::before {
        content: '\201C';
        position: absolute;
        top: 20px;
        left: 30px;
        font-size: 5rem;
        color: rgba(255, 196, 0, 0.2);
        font-family: serif;
        line-height: 1;
    }

    .testimonial-text {
        font-size: 1.2rem;
        font-style: italic;
        color: #4b5563;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .testimonial-author {
        font-weight: 700;
        font-size: 1.2rem;
        color: #1e293b;
        margin-bottom: 0.3rem;
    }

    .testimonial-role {
        color: #FFC400;
        font-size: 1rem;
        font-weight: 600;
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        border: 4px solid #FFC400;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #FFC400;
    }

    .slider-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
    }

    .slider-btn {
        background-color: transparent;
        border: 2px solid #FFC400;
        color: #FFC400;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .slider-btn:hover {
        background-color: #FFC400;
        color: white;
        transform: translateY(-3px);
    }

    /* CTA section */
    .cta {
        padding: 6rem 5%;
        background: linear-gradient(135deg, #FFC400 0%, #FFB100 100%);
        color: #333;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta::before,
    .cta::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .cta::before {
        top: -150px;
        right: -150px;
    }

    .cta::after {
        bottom: -150px;
        left: -150px;
    }

    .cta h2 {
        font-size: 2.8rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .cta p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 3rem;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .cta-primary {
        background-color: white;
        color: #FFC400;
        border: none;
        padding: 1.2rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .cta-primary:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .cta-secondary {
        background-color: transparent;
        color: #333;
        border: 2px solid #333;
        padding: 1.2rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .cta-secondary:hover {
        background-color: #333;
        color: white;
        transform: translateY(-5px);
    }



    /* Responsive styles */
    @media (max-width: 1200px) {
        .team-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {

        .mission-grid,
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .team-grid {
            grid-template-columns: repeat(2, 1fr);
        }



        .about-hero h1 {
            font-size: 3rem;
        }
    }

    @media (max-width: 768px) {
        .about-hero h1 {
            font-size: 2.5rem;
        }

        .section-heading h2 {
            font-size: 2rem;
        }

        .cta-button {
            display: none;
        }

        .mission-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .testimonial {
            padding: 2rem;
        }
    }

    @media (max-width: 576px) {

        .stats-grid,
        .team-grid,

        .about-hero {
            padding-top: 8rem;
        }

        .about-hero h1 {
            font-size: 2rem;
        }

        .cta h2 {
            font-size: 2.2rem;
        }

        .cta-buttons {
            flex-direction: column;
            gap: 1rem;
        }

        .testimonial-text {
            font-size: 1rem;
        }
    }
</style>

<!-- about-hero Section -->
<section class="about-hero">
    <div class="about-hero-content">
        <h1>Transforming Education Together</h1>
        <p>Learnhub is a community where Teacher share knowledge and students discover their potential through high-quality online courses.</p>
    </div>
</section>

<!-- Mission Section -->
<section class="mission">
    <div class="section-container">
        <div class="section-heading">
            <h2>Our Mission & Values</h2>
            <p>We're driven by a simple belief: education should be accessible, engaging, and transformative for everyone.</p>
        </div>
        <div class="mission-grid">
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Quality Education</h3>
                <p>We maintain high standards for our courses, ensuring students receive knowledge that's relevant, accurate, and actionable in today's fast-changing world.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Empowering Teachers</h3>
                <p>We provide talented teachers with the platform they need to share their expertise and earn income doing what they love while reaching students.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3>Enhance Accessibility</h3>
                <p>We're breaking down barriers to education by making learning accessible to students from all backgrounds regardless of geographic limitations.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team">
    <div class="section-container">
        <div class="section-heading">
            <h2>Meet Our Team</h2>
            <p>The passionate people behind LearnConnect who are dedicated to revolutionizing online education.</p>
        </div>
        <div class="team-grid">
            <div class="team-member">
                <div class="member-img-container">
                    <img src="/assets/images/user_placeholder.jpg" alt="Sachith" class="member-img">
                    <div class="member-overlay"></div>
                </div>
                <div class="member-info">
                    <h3>Sachith Dhanushka</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-img-container">
                    <img src="/assets/images/user_placeholder.jpg" alt="Dinuka" class="member-img">
                    <div class="member-overlay"></div>
                </div>
                <div class="member-info">
                    <h3>Dinuka Sahan</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-img-container">
                    <img src="/assets/images/user_placeholder.jpg" alt="mahima" class="member-img">
                    <div class="member-overlay"></div>
                </div>
                <div class="member-info">
                    <h3>Mahima De Silva</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-member">
                <div class="member-img-container">
                    <img src="/assets/images/user_placeholder.jpg" alt="Manupasan" class="member-img">
                    <div class="member-overlay"></div>
                </div>
                <div class="member-info">
                    <h3>Ravindu Manupasan</h3>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="section-container">
        <div class="stats-grid">
            <div class="stat-item">
                <h3 id="stat-teachers"><?= e($roundedStudentCount); ?>+</h3>
                <p>Expert Teachers</p>
            </div>
            <div class="stat-item">
                <h3 id="stat-courses"><?= e($roundedCourseCount); ?>+</h3>
                <p>Quality Courses</p>
            </div>
            <div class="stat-item">
                <h3 id="stat-students"><?= e($roundedTeacherCount); ?>+</h3>
                <p>Active Students</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="section-container">
        <h2>Ready to Start Your Learning Journey?</h2>
        <p>Join thousands of students and teachers who are transforming education together.</p>
        <div class="cta-buttons">
            <button class="cta-primary">Enroll Now</button>
            <button class="cta-secondary">Become a Teacher</button>
        </div>
    </div>
</section>

<script>
    // Testimonial slider functionality
    const testimonialContainer = document.querySelector('.testimonial-container');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');

    let currentIndex = 0;

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % testimonialContainer.children.length;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + testimonialContainer.children.length) % testimonialContainer.children.length;
        updateSlider();
    });

    function updateSlider() {
        const slideWidth = testimonialContainer.children[0].offsetWidth;
        testimonialContainer.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }

    // Mobile navigation
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
</script>
<?php include $this->resolve("partials/_footer.php"); ?>