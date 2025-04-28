<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join LearnHub</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <a href="/">
        <link rel="stylesheet" href="/assets/styles/choose-role.css">
    </a>
    <style>
        :root {
            --primary: #ffc400;
            --primary-hover: rgb(233, 206, 119);
            --accent: #ffc400;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --background: #ffffff;
            --background-alt: #f8fafc;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-dark);
            background-color: var(--background);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            background-color: var(--background);
            position: relative;
            z-index: 10;
        }

        .logo {
            height: 40px;
            transition: transform 0.2s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .login-button {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .login-button:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .main-container {
            display: flex;
            flex: 1;
        }

        .choose-role-container {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .choose-role-text h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .choose-role-form {
            max-width: 450px;
        }

        .role-option {
            margin-bottom: 1.5rem;
            position: relative;
            cursor: pointer;
            display: block;
            padding: 1.5rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .role-option:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        .role-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .role-option label {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
        }

        .role-option label::before {
            content: '';
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--border);
            margin-right: 12px;
            transition: all 0.2s ease;
        }

        .role-option input[type="radio"]:checked+label::before {
            border-color: var(--primary);
            background-color: var(--primary);
            box-shadow: inset 0 0 0 4px white;
        }

        .role-option input[type="radio"]:focus+label::before {
            box-shadow: inset 0 0 0 4px white, 0 0 0 3px rgba(37, 99, 235, 0.2);
        }

        .role-option label::after {
            content: '';
            width: 24px;
            height: 24px;
            margin-left: auto;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.7;
        }

        #tutor+label::after {
            background-image: url('/assets/icons/teacher-icon.svg');
        }

        #student+label::after {
            background-image: url('/assets/icons/student-icon.svg');
        }

        .submit-button-container {
            margin-top: 2rem;
        }

        .submit-button {
            background-color: var(--primary);
            color: white;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.15);
        }

        .submit-button:hover:not(:disabled) {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(37, 99, 235, 0.2);
        }

        .submit-button:active:not(:disabled) {
            transform: translateY(0px);
        }

        .submit-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
            }

            .right-banner {
                display: none;
            }

            .choose-role-container {
                padding: 2rem;
                align-items: center;
            }

            .choose-role-text h1 {
                font-size: 2rem;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="/assets/icons/lernhub-logo.png" alt="LearnHub Logo" class="logo">
        <button class="login-button" onclick="window.location.href='/login'">Log in</button>
    </nav>

    <div class="main-container">
        <div class="choose-role-container">
            <div class="choose-role-text">
                <h1>How do you want to use LEARN<span style="color: var(--accent);">HUB</span>?</h1>
            </div>
            <form method="POST" class="choose-role-form" id="roleForm" action="/choose-role">
                <?php include $this->resolve('partials/_csrf.php') ?>
                <div class="role-option">
                    <input type="radio" id="tutor" name="role" value="teacher">
                    <label for="tutor">I'm a Tutor</label>
                </div>
                <div class="role-option">
                    <input type="radio" id="student" name="role" value="student">
                    <label for="student">I'm a Student</label>
                </div>
                <div class="submit-button-container">
                    <button type="submit" class="submit-button" disabled>Create account</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const roleForm = document.getElementById('roleForm');
        const submitBtn = document.querySelector('.submit-button');
        const roleOptions = document.querySelectorAll('.role-option');

        // Enable/disable submit button based on selection
        roleForm.addEventListener('change', () => {
            submitBtn.disabled = !roleForm.role.value;
        });

        // Add visual feedback when option is selected
        roleOptions.forEach(option => {
            option.addEventListener('click', () => {
                const radio = option.querySelector('input[type="radio"]');
                radio.checked = true;

                // Trigger change event to enable submit button
                const event = new Event('change');
                roleForm.dispatchEvent(event);
            });
        });
    </script>
</body>

</html>