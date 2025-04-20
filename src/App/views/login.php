<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LearnHub</title>
    <link rel="stylesheet" href="/assets/styles/login-style.css">
</head>

<body>
    <nav class="navbar">
        <img src="/assets/icons/lernhub-logo.png" alt="Logo" class="logo">
        <svg class="help-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z" />
        </svg>
    </nav>

    <div class="page">
        <div class="container">
            <h1 class="header-text">Welcome back</h1>
            <p class="subtitle">Log in to your account</p>
            <form method="POST">
                <?php include $this->resolve('partials/_csrf.php') ?>

                <div class="form-group">
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div style="color: red; text-align:center">
                            <?php echo e($errors['password'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <label for="email">Email</label>
                    <div class="input-wrapper">

                        <!-- Mail icon -->
                        <svg class="input-icon left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <input
                            name="email"
                            type="email"
                            id="email"
                            value="<?php echo e($oldFormData['email'] ?? '') ?>"
                            placeholder="Enter your email">
                        <?php if (array_key_exists('email', $errors)) : ?>
                            <div>
                                <?php echo e($errors['email'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">

                        <!-- Lock icon -->
                        <svg class="input-icon left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Enter your password">

                        <!-- password visibility change icon -->
                        <svg class="input-icon right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                        </svg>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        <span class="checkbox">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                            </svg>
                        </span>
                        Remember me
                    </label>
                </div>
                <button type="submit" class="login-button">Log in</button>
            </form>
            <a href="#" class="forgot-password">Forgot password?</a>
            <p class="signup">Don't have and account? <a href="/register" style="color: #FFC400;"> Sign Up </a></p>
        </div>
    </div>
    <!-- Popup -->
    <!-- <div class="popup" id="loginPopup">
        <div class="popup-content">
            <h2 class="popup-title">Select Login Type</h2>
            <div class="popup-options">
                <button class="popup-option" onclick="selectLoginType('student')">Login as a Student</button>
                <button class="popup-option" onclick="selectLoginType('tutor')">Login as a Tutor</button>
            </div>
            <p class="signup">Don't have and account? <a href="../Signup/choose-role.html" style="color: #FFC400;"> Signup </a></p>
        </div>
    </div> -->

    <script>
        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const togglePassword = passwordInput.nextElementSibling;

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ?
                '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>' :
                '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';
        });

        // Show popup after 1 second
        setTimeout(() => {
            const popupOverlay = document.getElementById('loginPopup');
            const content = document.querySelector('.page');
            popupOverlay.classList.add('show');
            content.classList.add('blurred');
        }, 1000);

        // Function to handle login type selection
        function selectLoginType(type) {
            console.log(`Selected login type: ${type}`);
            document.getElementById('loginPopup').classList.remove('show');
            document.querySelector('.page').classList.remove('blurred');
        }
    </script>
</body>

</html>