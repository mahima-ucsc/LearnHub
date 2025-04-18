<?php include $this->resolve("partials/_header.php"); ?>

<style>
    :root {
        --theme-color: #ffc400;
        --dark-color: #333;
        --light-color: #f8f8f8;
    }

    .unauth-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* min-height: 80vh; */
        width: 100%;
    }

    .error-img {
        width: 100%;
        max-width: 400px;
        height: auto;
    }

    .error-title {
        font-size: 3rem;
        color: var(--dark-color);
    }

    .error-title span {
        color: var(--theme-color);
        font-weight: bold;
    }

    .error-message {
        font-size: 1.2rem;
        color: #555;
        line-height: 1.6;
        max-width: 600px;
    }

    .home-button {
        padding: 12px 24px;
        background-color: var(--theme-color);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .home-button:hover {
        background-color: #e8b000;
        transform: translateY(-3px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .home-button:active {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .error-title {
            font-size: 2.5rem;
        }

        .error-img {
            max-width: 300px;
        }

        .error-message {
            font-size: 1rem;
            padding: 0 15px;
        }
    }

    @media (max-width: 480px) {
        .error-title {
            font-size: 2rem;
        }

        .error-img {
            max-width: 240px;
        }
    }
</style>
<div class="unauth-container">
    <img src="/assets/images/Unauthorized.png" alt="401 Unauthorized Access" class="error-img">

    <h1 class="error-title">Error <span>401</span></h1>

    <p class="error-message">
        Sorry, you don't have permission to access this page.
        Please check your credentials or contact the administrator if you believe this is a mistake.
    </p>

    <a href="/" class="home-button">Go Back to Home</a>
</div>

<?php include $this->resolve("partials/_footer.php"); ?>