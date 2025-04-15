<?php include $this->resolve("partials/_header.php"); ?>
<link rel="stylesheet" href="/assets/styles/create-form.css">
<link rel="stylesheet" href="/assets/styles/Payment/course-subperiod-payment.css">

<section class="create-container">
    <div class="create-header">
        <h1>Enroll in the Course</h1>
    </div>

    <div class="course-details">
        <div class="detail-item">
            <span class="label">Course:</span>
            <span class="value"><?= e($course_title) ?></span>
        </div>
        <?php if ($billing_type === 'recurring'): ?>
            <div class="detail-item">
                <span class="label">Start Date:</span>
                <span class="value"><?= e(formatDate($start_date, 'F j, Y')) ?></span>
            </div>
            <div class="detail-item">
                <span class="label">End Date:</span>
                <span class="value"><?= e(formatDate($end_date, 'F j, Y')) ?></span>
            </div>
        <?php endif; ?>
        <div class="detail-item">
            <span class="label">Amount:</span>
            <span class="value"><?= $amount ?></span>
        </div>
    </div>

    <form class="create-form" id="coursePaymentForm" method="POST" action=<?= "/payment/courses/" . $courseId . "/" . $subperiodId ?>>
        <div class="create-section">
            <div class="create-form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="create-form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="create-form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="create-form-group">
                <label for="phone">Phone *</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="create-form-group">
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="create-form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" required>
            </div>
        </div>

        <button type="submit" class="create-submit">Proceed to Pay</button>
    </form>
</section>
<?php include $this->resolve("partials/_footer.php"); ?>