<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 300px;
    }

    h2 {
        margin-bottom: 20px;
        color: #6c757d;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"] {
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    button {
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    #submitBtn {
        background-color: #ffc400;
        color: rgb(0, 0, 0);
    }

    #submitBtn:hover {
        background-color: rgba(255, 196, 0, 0.83);
    }

    #resendBtn {
        background-color: #007bff;
        color: #fff;
    }

    #resendBtn:disabled {
        background-color: #6c757d;
    }

    #resendBtn:hover:enabled {
        background-color: #0056b3;
    }

    .error-message {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #ff5252;
        color: white;
        padding: 12px 20px;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        text-align: center;
        font-size: 16px;
        max-width: 80%;
        animation: fadeIn 0.3s ease-out;
        transition: opacity 0.5s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, -20px);
        }

        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }
</style>

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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var resendBtn = document.getElementById('resendBtn');
            var timer = 10;
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