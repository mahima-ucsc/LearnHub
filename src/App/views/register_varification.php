<body>
    <div class="container">
        <h2>Enter Verification Code</h2>
        <form method="POST" action="/verify-otp">
            <input type="text" id="verificationCode" name="verificationCode" placeholder="Enter Code" maxlength="6" required>
            <br>
            <button type="submit" id="submitBtn">Submit</button>
        </form>
        <br>
        <button id="resendBtn" disabled>Resend Code (30s)</button>
    </div>

    <script>
        // let timer = 30;
        // const resendBtn = document.getElementById("resendBtn");
        // const submitBtn = document.getElementById("submitBtn");

        // // Event listener for submitting the verification code
        // submitBtn.addEventListener("click", () => {
        //     const code = document.getElementById("verificationCode").value;
        //     <?php
                //     // $hashCode = password_hash($code, PASSWORD_DEFAULT, ["cost" => 12]);
                //     dd($code);
                //     dd($_SESSION['otp_hash']);
                //     // if ($hashCode === $_SESSION['otp_hash']) {
                //     //     echo "alert('Verification code submitted: ' + code);";
                //     // } else {
                //     //     echo "alert('Invalid verification code!');";
                //     // }
                //     // 
                //     
                ?>
        //     // alert("Verification code submitted: " + code);
        // });

        // // Function to handle the countdown for the resend button
        // const countdown = setInterval(() => {
        //     timer--; // Decrease timer by 1 second
        //     resendBtn.textContent = `Resend Code (${timer}s)`;
        //     if (timer === 0) {
        //         clearInterval(countdown); // Stop the timer when it reaches 0
        //         resendBtn.textContent = "Resend Code";
        //         resendBtn.disabled = false; // Enable the resend button
        //     }
        // }, 1000);

        // // Event listener for the resend button
        // resendBtn.addEventListener("click", () => {
        //     alert("Verification code resent!");
        //     resendBtn.disabled = true; // Disable the button to prevent multiple clicks
        //     timer = 30; // Reset timer to 30 seconds
        //     resendBtn.textContent = `Resend Code (${timer}s)`;

        //     // Start a new countdown when the button is clicked
        //     const newCountdown = setInterval(() => {
        //         timer--;
        //         resendBtn.textContent = `Resend Code (${timer}s)`;
        //         if (timer === 0) {
        //             clearInterval(newCountdown); // Stop the timer when it reaches 0
        //             resendBtn.textContent = "Resend Code";
        //             resendBtn.disabled = false; // Enable the button again
        //         }
        //     }, 1000);
        // });
    </script>
</body>