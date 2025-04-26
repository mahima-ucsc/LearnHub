<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/help-and-support.css">


<div class="head-container">

</div>
<div class="head">
    <h2>How can we help you?</h2>
    <p>Find answers to your questions, explore guides, or connect with our support team to get the help you need.</p>
</div>

<section class="help">

    <!-- FAQ secton -->
    <section class="FAQ">
        <h2>Frequently Asked Questions (FAQs)</h2>

        <!-- General Questions -->
        <div class="faq-section">
            <h3>General Questions</h3>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">What is LearnHub?</p>
                <p class="faq-answer">LearnHub is an online platform that connects tutors and learners, offering tools for course creation, enrollment, and communication to enhance learning experiences.</p>
            </div>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">How do I sign up for LearnHub?</p>
                <p class="faq-answer">Click the "Sign Up" button on the homepage and fill in the required details. You can sign up as a student or tutor.</p>
            </div>
        </div>

        <!-- Account Management -->
        <div class="faq-section">
            <h3>Account Management</h3>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">How can I change my profile name?</p>
                <p class="faq-answer">Go to your account settings or profile page, find the edit option next to your name, and update it with your preferred name.</p>
            </div>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">Can I change my account type from student to tutor?</p>
                <p class="faq-answer">No, you cannot change your account type once it is set. If you require assistance, please contact support for further guidance.</p>
            </div>
        </div>

        <!-- Course Management -->
        <div class="faq-section">
            <h3>Course Management</h3>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">How do I enroll in a course?</p>
                <p class="faq-answer">Search for a course using the search bar, click on the course you’re interested in, and hit the "Enroll" button.</p>
            </div>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">Can I unenroll from a course?</p>
                <p class="faq-answer">No, you cannot unenroll from a course after payment has been made, as we do not offer refunds. Please ensure your selection before making a payment.</p>
            </div>
        </div>

        <!-- Technical Issues -->
        <div class="faq-section">
            <h3>Technical Issues</h3>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">I can’t log in to my account. What should I do?</p>
                <p class="faq-answer">Check your email and password for errors. If the problem persists, please contact our support team.</p>
            </div>
            <div class="faq-item">
                <p class="faq-question" tabindex="0">The website isn’t loading properly. What can I do?</p>
                <p class="faq-answer">Ensure your browser is updated and clear your cache. If the issue continues, contact our support team.</p>
            </div>
        </div>
    </section>

    <!-- quction and sugetions -->
    <section class="question-suggestion-section">
        <div class="container">
            <h2>Have Questions or Suggestions?</h2>
            <p>We value your feedback! Let us know your thoughts, questions, or suggestions to improve your experience.</p>

            <form class="feedback-form" action="/help-and-support" method="POST">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required />
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required />
                </div>

                <!-- Message Field -->
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="4" placeholder="Type your question or suggestion here..." required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <div class="help-submit">
                        <button type="submit" class="submit-btn">Send Message</button>

                    </div>
                </div>
            </form>
        </div>
    </section>

</section>

<?php include $this->resolve("partials/_footer.php"); ?>

<script>
    function contactUs() {
        window.location.href = "/contact";
    }

    function getSupport() {
        window.location.href = "/course/request";
    }

    // JavaScript to toggle FAQ answers
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>