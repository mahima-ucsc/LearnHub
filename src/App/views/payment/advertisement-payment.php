<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/Payment/course-payment.css">

<section class="payment-container">
    <div class="payment-header">
        <h1>Place Your Advertisement</h1>
        <p class="subtitle">Complete your payment details below to promote your content</p>
    </div>

    <div class="course-details">
        <div class="detail-item">
            <span class="label">Course:</span>
            <span class="value"><?= e($courseTitle) ?></span>
        </div>
        <div class="detail-item">
            <span class="label">Package:</span>
            <span class="value"><?= e($courseTitle) ?></span>
        </div>
        <div class="detail-item">
            <span class="label">Amount:</span>
            <span class="value"><?= "Rs. " . e($amount) ?></span>
        </div>
    </div>

    <form class="payment-form" id="coursePaymentForm" method="POST" action=<?= "" ?>>
        <h2>Personal Information</h2>

        <div class="form-grid">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="John" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="john.doe@example.com" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" placeholder="+1 (555) 123-4567" required>
            </div>

            <div class="form-group full-width">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="123 Main Street" required>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="New York" required>
            </div>
        </div>

        <button type="submit" class="payment-button">
            <span>Proceed to Payment</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </button>
    </form>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>