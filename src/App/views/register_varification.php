<link rel="stylesheet" href="/assets/styles/register_verification.css">

<body>
    <!-- if varification PIN wrong -->
    <?php if (isset($errors['verificationCode'])): ?>
        <div class="error-message">
            <?= htmlspecialchars($errors['verificationCode'][0]) ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2>Enter Verification Code</h2>
        <form method="POST" action="/verify-otp">
            <input type="text" id="verificationCode" name="verificationCode" placeholder="Enter Code" maxlength="6" required>
            <br>
            <button type="submit" id="submitBtn">Submit</button>
        </form>
        <form method="POST" action="/resend-otp">
            <button type="submit" id="resendBtn" disabled>Resend Code (30s)</button>
        </form>
        <p class="text">
            This verification code will expire in 5 minutes.
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var resendBtn = document.getElementById('resendBtn');
            var timer = 30;
            var interval = setInterval(function() {
                timer--;
                resendBtn.textContent = 'Resend Code (' + timer + 's)';
                if (timer <= 0) {
                    clearInterval(interval);
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend Code';
                }
            }, 1000);
        });

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const errorMsg = document.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.style.opacity = '0';
                    errorMsg.style.transition = 'opacity 0.5s';
                    setTimeout(function() {
                        errorMsg.remove();
                    }, 500);
                }
            }, 5000);
        });
    </script>
</body>