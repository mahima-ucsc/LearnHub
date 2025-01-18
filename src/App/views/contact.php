<head>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="/assets/styles/contact.css">

</head>

<?php include $this->resolve("partials/_header.php"); ?>

<body>

    <section class="contact">

        <div class="row">

            <div class="left-side">
                <div class="hedeline">
                    <h3>Reach Out</h3>
                    <h2>Anytime!</h2>
                </div>
                <span>Have a question or idea? We’d love to hear from you—let’s make your experience better!</span>

                <img src="/assets/images/contact-img.svg" alt="">

            </div>

            <form action="/contact" method="POST">
                <h3>get in touch</h3>
                <input id="name" type="text" placeholder="enter your name" name="name" required maxlength="50" class="input-feild inputs">
                <input id="email" type="email" placeholder="enter your email" name="email" required maxlength="50" class="input-feild inputs">
                <textarea id="message" name="message" class="input-message inputs" placeholder="enter your message" required maxlength="1000" cols="30" rows="10"></textarea>
                <input id="sendButton" type="submit" value="send message" class="btn" name="submit">

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert error">
                        <?= htmlspecialchars($_SESSION['error_message']) ?>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert success">
                        <?= htmlspecialchars($_SESSION['success_message']) ?>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li style="color: red;"><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>
            </form>

        </div>
        <!-- <i class="fas fa-envelope"></i>
        <i class="fas fa-phone"></i> -->

    </section>


    <!-- <script>
        document.getElementById('sendButton').addEventListener('click', function() {

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = "Contact us";
            const message = document.getElementById('message').value;

            const body = `Name: ${name}\nEmail: ${email}\n\nMessage:\n${message}`;
            const mailtoLink = `mailto:leanhubcontact@gmail.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;


            window.location.href = mailtoLink;
        });
    </script> -->


</body>

<?php include $this->resolve("partials/_footer.php"); ?>