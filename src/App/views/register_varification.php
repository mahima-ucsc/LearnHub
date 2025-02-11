<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 18px;
            text-align: center;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Enter Verification Code</h2>
        <input type="text" id="verificationCode" placeholder="Enter Code" maxlength="6">
        <br>
        <button id="submitBtn">Submit</button>
        <br>
        <button id="resendBtn" disabled>Resend Code (30s)</button>
    </div>

    <script>
        let timer = 30; // Initial countdown time in seconds
        const resendBtn = document.getElementById("resendBtn");
        const submitBtn = document.getElementById("submitBtn");

        // Event listener for submitting the verification code
        submitBtn.addEventListener("click", () => {
            const code = document.getElementById("verificationCode").value;
            alert("Verification code submitted: " + code);
        });

        // Function to handle the countdown for the resend button
        const countdown = setInterval(() => {
            timer--; // Decrease timer by 1 second
            resendBtn.textContent = `Resend Code (${timer}s)`;
            if (timer === 0) {
                clearInterval(countdown); // Stop the timer when it reaches 0
                resendBtn.textContent = "Resend Code";
                resendBtn.disabled = false; // Enable the resend button
            }
        }, 1000);

        // Event listener for the resend button
        resendBtn.addEventListener("click", () => {
            alert("Verification code resent!");
            resendBtn.disabled = true; // Disable the button to prevent multiple clicks
            timer = 30; // Reset timer to 30 seconds
            resendBtn.textContent = `Resend Code (${timer}s)`;

            // Start a new countdown when the button is clicked
            const newCountdown = setInterval(() => {
                timer--;
                resendBtn.textContent = `Resend Code (${timer}s)`;
                if (timer === 0) {
                    clearInterval(newCountdown); // Stop the timer when it reaches 0
                    resendBtn.textContent = "Resend Code";
                    resendBtn.disabled = false; // Enable the button again
                }
            }, 1000);
        });
    </script>
</body>

</html>