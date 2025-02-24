<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Success</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

    <style>
        .success-container {
            text-align: center;
            margin: 100px auto;
            max-width: 600px;
            padding: 20px;
        }

        .success-message {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .home-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffc400;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .home-button:hover {
            background-color: rgba(255, 196, 0, 0.8);
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div id="animation-container">
            <div id="lottie-animation"></div>
        </div>
        <div class="success-message">
            Thank you for contacting us!
        </div>
        <p>Your message has been successfully sent. We will get back to you soon.</p>
        <a href="/" class="home-button">Back to Home</a>
    </div>
    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/assets/icons/icons8-success.json'
        });
    </script>

</body>

</html>