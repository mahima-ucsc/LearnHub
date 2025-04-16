<?php include $this->resolve("partials/_header.php"); ?>

<style>
    .error-page-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* min-height: 80vh; */
        width: 100%;
    }

    .error-img {
        max-width: 20%;
        height: auto;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 3rem;
        margin-bottom: 10px;
        color: #333;
    }

    .highlight {
        color: #ffc400;
    }

    p {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .home-btn {
        display: inline-block;
        background-color: #ffc400;
        color: #333;
        font-weight: bold;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid #ffc400;
    }

    .home-btn:hover {
        background-color: transparent;
        color: #ffc400;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 196, 0, 0.3);
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 2.2rem;
        }

        p {
            font-size: 1rem;
        }

        .error-page-container {
            padding: 20px;
        }
    }
</style>

<div class="error-page-container">
    <img src="/assets/images/404.jpg" alt="404 Error" class="error-img">
    <h1>Oops! <span class="highlight">Page Not Found</span></h1>
    <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
    <a href="/" class="home-btn">Go Back To Home</a>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>