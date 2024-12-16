<?php include $this->resolve("partials/_header.php") ?>

<head>
    <link rel="stylesheet" href="/assets/styles/User/Admin/help_and_support_review.css">
</head>

<body>
    <section>
        <section class="support-chat-section">
            <div class="container">
                <!-- Header -->
                <div class="chat-header">
                    <h2>Support Ticket Chat</h2>
                    <p>We're here to assist you. Start a conversation with our support team.</p>
                </div>

                <!-- Chat Window -->
                <div class="chat-window">
                    <div class="messages">
                        <!-- Example Messages -->
                        <div class="message user-message">
                            <p>Hi, I need help with my account.</p>
                        </div>
                        <div class="message support-message">
                            <p>Hello! How can I assist you today?</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Input -->
                <form class="chat-input-form">
                    <input
                        type="text"
                        id="chat-message"
                        placeholder="Type your message here..."
                        required />
                    <button type="submit">
                        send
                    </button>
                </form>
            </div>
        </section>

    </section>
</body>

<?php include $this->resolve("partials/_footer.php") ?>