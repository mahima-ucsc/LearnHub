<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | LearnHub</title>
    <link rel="stylesheet" href="/assets/styles/signup-style.css">
</head>

<body>
    <nav class="navbar">
        <img src="/assets/icons/lernhub-logo.png" alt="LearnHub Logo" class="logo">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Help</a></li>
        </ul>
        <a class="login-button" href="/login">Log in</a>

    </nav>

    <div class="page">
        <div class="container">
            <h1 class="header-text">Welcome to Learn<span style="color: #ffc400;">Hub</span></h1>
            <p class="subtitle">Start your learning journey with LearnHub today!</p>

            <form id="signup-form" method="POST" action="/register">
                <?php include $this->resolve('partials/_csrf.php') ?>
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input type="text" name="first_name" id="fname" placeholder="First Name" required>
                    </div>
                    <?php if (array_key_exists('first_name', $errors)) : ?>
                        <div class='register-error'>
                            <?php echo e($errors['first_name'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input type="text" name="last_name" id="lname" placeholder="Last Name" required>
                    </div>
                    <?php if (array_key_exists('last_name', $errors)) : ?>
                        <div class='register-error'>
                            <?php echo e($errors['last_name'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input type="email" name="email" id="email" placeholder="Email Address" required>
                    </div>
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class='register-error'>
                            <?php echo e($errors['email'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75-1.5.75a3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0 3.354 3.354 0 0 0-3 0 3.354 3.354 0 0 1-3 0L3 16.5m15-3.379a48.474 48.474 0 0 0-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 0 1 3 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 0 1 6 13.12M12.265 3.11a.375.375 0 1 1-.53 0L12 2.845l.265.265Zm-3 0a.375.375 0 1 1-.53 0L9 2.845l.265.265Zm6 0a.375.375 0 1 1-.53 0L15 2.845l.265.265Z" />
                        </svg>

                        <input type="date" name="date_of_birth" id="dob" placeholder="Date of Birth" required>
                    </div>
                    <?php if (array_key_exists('date_of_birth', $errors)) : ?>
                        <div class='register-error'>
                            <?php echo e($errors['date_of_birth'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class='register-error'>
                            <?php echo e($errors['password'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" name="confirmPassword" id="confirm-password" placeholder="Confirm Password" required>
                    </div>
                    <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                        <div class='register-error'>
                            <?php echo e($errors['confirmPassword'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="show-password">
                        <label for="show-password">
                            <span class="checkbox">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                </svg>
                            </span>
                            Show Password
                        </label>
                    </div>
                </div>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="terms" style="color:black;">
                    <label for="terms">
                        <span class="checkbox">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                            </svg>
                        </span>
                        By signing up, I confirm that I agree to the Terms and Conditions and Privacy Policy.
                    </label>
                </div>
                <button type="submit" class="signup-button">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');
            const showPasswordCheckbox = document.getElementById('show-password');

            showPasswordCheckbox.addEventListener('change', function() {
                const type = this.checked ? 'text' : 'password';
                password.type = type;
                confirmPassword.type = type;
            });

        });
    </script>
</body>

</html>